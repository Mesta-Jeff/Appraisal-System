<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Student;
use App\Models\Lecturer;
use App\Mail\GeneralMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //TODO:  list of users
    public function usersAccount(Request $request)
    {
        if ($request->ajax()) {
            $students = DB::table('users as s')
                ->join('roles as c', 's.role_id', '=', 'c.id')
                ->select(
                    's.*',
                    'c.role'
                )
                ->where('s.is_deleted', 'No')
                ->orderBy('s.name', 'asc')
                ->get();

            return response()->json(['status' => 'success', 'users' => $students]);
        }
        // Your logic here
        return view('settings.users');
    }


    //TODO: RESETTING PASSWORD BY ADMIN 
    public function resetPassword(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
        }

        try {
            // Validate the input
            $validator = Validator::make($request->all(), [
                'id' => 'required|exists:users,id',
                'referer_id' => 'required|string|max:20|exists:users,referer_id',
            ]);

            // If validation fails, return JSON response with validation errors
            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'errors' => $validator->errors()->all()], 422);
            }

            $validatedData = $validator->validated();

            // Fetch dob from either Student or Lecturer table based on referer_id
            $phone = Student::where('id', $validatedData['referer_id'])->value('phone') ??
                Lecturer::where('id', $validatedData['referer_id'])->value('phone');

            if (!$phone) {
                return response()->json(['status' => 'error', 'message' => 'Phone number not found.'], 404);
            }

            // Update the user's password with the hashed dob
            $updatedUser = User::where('id', $validatedData['id'])
                ->where('referer_id', $validatedData['referer_id'])
                ->update(['password' => Hash::make($phone)]);

            if ($updatedUser) {
                return response()->json(['status' => 'success', 'message' => 'Operation performed successfully, Password has been reset to default.']);
            }

            return response()->json(['status' => 'error', 'message' => 'Operation failed, please try again.'], 500);
        } catch (\Exception $e) {
            Log::error('Exception during operation: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'An error occurred while updating the password.'], 500);
        }
    }

    //TODO: RESETTING email BY ADMIN 
    public function resetEmail(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
        }

        try {
            // Validate the input
            $validator = Validator::make($request->all(), [
                'id' => 'required|exists:users,id',
                'newmail' => 'required|email',
                'referer_id' => 'required|string|max:20|exists:users,referer_id',
            ]);

            // If validation fails, return JSON response with validation errors
            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'errors' => $validator->errors()->all()], 422);
            }

            $validatedData = $validator->validated();

            // Update the user's email
            $updatedUser = User::where('id', $validatedData['id'])->where('referer_id', $validatedData['referer_id'])->update(['email' => $validatedData['newmail']]);

            if (!$updatedUser) {
                return response()->json(['status' => 'error', 'message' => 'Operation failed, please try again.'], 500);
            }

            // Update email in either Student or Lecturer table based on referer_id
            $updatedReferer = Student::where('id', $validatedData['referer_id'])->update(['email' => $validatedData['newmail']]);

            if (!$updatedReferer) {
                $updatedReferer = Lecturer::where('id', $validatedData['referer_id'])->update(['email' => $validatedData['newmail']]);
            }

            if ($updatedReferer) {
                return response()->json(['status' => 'success', 'message' => 'Operation performed successfully, Email has been reset now.']);
            }

            return response()->json(['status' => 'error', 'message' => 'Operation failed, please try again.'], 500);
        } catch (\Exception $e) {
            Log::error('Exception during operation: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'An error occurred while updating the email.'], 500);
        }
    }


    
    //TODO:  Students list
    public function Students(Request $request)
    {
        if ($request->ajax()) {

            // Get the current role and necessary details from the session
            $currentRole = $request->session()->get('role');
            $departmentId = $request->session()->get('department');
            $facultyId = $request->session()->get('faculty');

            $query = DB::table('students as s')
                ->join('programmes as p', 's.programme_id', '=', 'p.id')
                ->join('classes as c', 's.class_id', '=', 'c.id')
                ->join('departments as d', 'd.id', '=', 'p.department_id')
                ->select('s.*','p.programme','c.class')
                ->where('s.is_deleted', 'No');

                // Apply role-based filtering
            if (in_array($currentRole, ['Developer', 'Head QA'])) {
                // No additional filters
            } elseif ($currentRole === 'HOD' || $currentRole === 'Officer') {
                $query->where('p.department_id', $departmentId);
            } elseif ($currentRole === 'Dean' || $currentRole === 'Administrator') {
                $query->where('d.faculty_id', $facultyId);
            }
            $students = $query->orderBy('s.id', 'desc')->get();

            return response()->json(['status' => 'success', 'students' => $students]);
        }

        // Your logic here
        return view('settings.students');
    }

    //TODO:  BUlk adding of students
    public function StudentsAddBulk(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
        }

        try {
            $students = $request->all();
       
            // Start transaction
            DB::beginTransaction();
            $roleId = DB::table('roles')->where('role', 'Student')->value('id');

            foreach ($students as $student) {

                $validator = Validator::make($student, [
                    'first_name' => 'required|string|max:255',
                    'middle_name' => 'nullable|string|max:255',
                    'last_name' => 'required|string|max:255',
                    'dob' => 'required|date',
                    'gender' => 'required|string',
                    'phone' => 'required|string|max:10|unique:students,phone',
                    'email' => 'required|email|unique:students,email',
                    'student_number' => 'required|string|max:20|unique:students,student_number',
                    'class_id' => 'required|exists:classes,id',
                    'programme_id' => 'required|exists:programmes,id',
                ], [
                    'email.unique' => 'The email :input has already been taken.',
                    'student_number.unique' => 'The student number :input has already been taken.',
                    'phone.unique' => 'The phone number :input has already been taken.',
                ]);

                if ($validator->fails()) {
                    // Log detailed validation errors
                    Log::error('Validation failed for student: ' . json_encode($student) . ' Errors: ' . json_encode($validator->errors()->all()));
                    DB::rollBack();             
                    return response()->json(['status' => 'error', 'message' => $validator->errors()->all()], 422);
                }

                // Calculate initials
                $initials = strtoupper(substr($student['last_name'], 0, 1) . ($student['middle_name'] ? substr($student['middle_name'], 0, 1) : '') . substr($student['first_name'], 0, 1));
                $student['initials'] = $initials;

                // Create student
                $createdStudent = Student::create($student);

                // Prepare user data
                $userData = [
                    'role_id' => $roleId,
                    'referer_id' => $createdStudent->id,
                    'name' => $student['first_name'] . ' ' . ($student['middle_name'] ? $student['middle_name'] . ' ' : '') . $student['last_name'],
                    'email' => $student['email'],
                    'username' => $student['student_number'],
                    // 'password' => bcrypt($student['dob']),
                    'password' => Hash::make($student['phone']),
                ];
                User::create($userData);

                // Prepare email content
                $loginUrl = route('login');
                $letterHeading = 'ACCOUNT CREDENTIALS';
                $letterContent = "
                    <strong>Username:</strong> {$userData['username']}<br>
                    <strong>Password:</strong> {$student['phone']}<br>
                    Please use the following link to log in:<br>
                    <a href='{$loginUrl}'>Login Here</a>
                ";

                // Send email with credentials
                Mail::to($student['email'])->send(new GeneralMail(
                    $letterHeading,
                    $student['first_name'] . ' ' . ($student['middle_name'] ? $student['middle_name'] . ' ' : '') . $student['last_name'],
                    'Student',
                    'TEAM QA',
                    'Chairman General',
                    $letterHeading,
                    $letterContent 
                ));
            }

            DB::commit();
            Log::info('Successfully added students: ' . json_encode($students));

            return response()->json(['status' => 'success', 'message' => 'Students added successfully.']);
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Exception during bulk student addition: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'An error occurred while adding students.'], 500);
        }
    }

    // Singly adding students
    public function updateStudents(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
        }

        try {
            // Validate the input
            $validator = Validator::make($request->all(), [
                'id' => 'required|exists:students,id',
                'first_name' => 'required|string|max:255',
                'middle_name' => 'nullable|string|max:255',
                'last_name' => 'required|string|max:255',
                'dob' => 'required|date',
                'gender' => 'required|string',
                'phone' => 'required|string|max:10|unique:students,phone,' . $request->id,
                'email' => 'required|email|unique:students,email,' . $request->id,
                'student_number' => 'required|string|max:20|unique:students,student_number,' . $request->id,
                'class_id' => 'required|exists:classes,id',
                'programme_id' => 'required|exists:programmes,id',
            ]);

            // If validation fails, return JSON response with validation errors
            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'errors' => $validator->errors()->all()], 422);
            }

            $validatedData = $validator->validated();

            // Calculate initials
            $initials = strtoupper(
                substr($validatedData['last_name'], 0, 1) .
                ($validatedData['middle_name'] ? substr($validatedData['middle_name'], 0, 1) : '') .
                substr($validatedData['first_name'], 0, 1)
            );
            $validatedData['initials'] = $initials;

            // Update the record with validated fields
            $updatedStudent = Student::where('id', $validatedData['id'])->update($validatedData);

            if ($updatedStudent) {
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, record updated you can check it out']);
            }

            return response()->json(['status' => 'error', 'message' => 'Sorry! operation failed, data could not be updated'], 500);
        } catch (\Exception $e) {
            Log::error('Exception during operation: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'An error occurred while updating the student.'], 500);
        }
    }

    //todo:  Desttroy Student
    public function destroyStudent(Request $request)
    {
        if ($request->ajax()) {
            $request->validate(['id' => 'required|exists:students,id',]);

            try {
                Student::where('id', $request->id)->update(['is_deleted' => 'Yes']);
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, record removed']);
            } catch (\Exception $e) {
                Log::error('Exception during operation: ' . $e->getMessage());
                return response()->json(['status' => 'error', 'message' => 'Operation failed.'], 500);
            }
        }
        return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
    }

    //todo: BULK Promote
    public function promoteStudent(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
        }

        try {
            // Validate the request data
            $validator = Validator::make($request->all(), [
                'student_number' => 'required|array',
                'student_number.*' => 'required|exists:students,student_number',
                'class_id' => 'required|exists:classes,id',
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'message' => $validator->errors()->all()], 422);
            }

            $studentNumbers = $request->input('student_number');
            $classId = $request->input('class_id');

            // Bulk update using whereIn
            DB::table('students')->whereIn('student_number', $studentNumbers)->update(['class_id' => $classId]);

            return response()->json(['status' => 'success', 'message' => 'Students promoted successfully']);
        } catch (\Exception $e) {
            Log::error('Exception during student promotion: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'An error occurred while promoting students.'], 500);
        }
    }


    //2009-06-29

    //TODO: list of staff

    public function Staff(Request $request)
    {
        if ($request->ajax()) {
            // Get the current role and necessary details from the session
            $currentRole = $request->session()->get('role');
            $departmentId = $request->session()->get('department');
            $facultyId = $request->session()->get('faculty');

            // Initialize the query
            $query = DB::table('lecturers as s')
                ->join('departments as p', 's.department_id', '=', 'p.id')
                ->join('roles as c', 's.role_id', '=', 'c.id')
                ->select('s.*', 'p.department', 'c.role', 'p.faculty_id')
                ->where('s.is_deleted', 'No');

            // Apply role-based filtering
            if (in_array($currentRole, ['Developer', 'Head QA'])) {
                // No additional filters
            } elseif ($currentRole === 'HOD' || $currentRole === 'Officer') {
                $query->where('s.department_id', $departmentId);
            } elseif ($currentRole === 'Dean' || $currentRole === 'Administrator') {
                $query->where('p.faculty_id', $facultyId);
            }

            // Execute the query and get the results
            $staff = $query->orderBy('s.id', 'desc')->get();

            return response()->json(['status' => 'success', 'staffs' => $staff]);
        }

        return view('settings.staffs');
    }


    //TODO:  BUlk adding of students
    public function StaffBulkAdd(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
        }

        try {
            $staffs = $request->all();
       
            // Start transaction
            DB::beginTransaction();

            foreach ($staffs as $staff) {

                $validator = Validator::make($staff, [
                    'first_name' => 'required|string|max:255',
                    'middle_name' => 'nullable|string|max:255',
                    'last_name' => 'required|string|max:255',
                    'dob' => 'required|date',
                    'gender' => 'required|string',
                    'type' => 'required|string',
                    'title' => 'required|string',
                    'phone' => 'required|string|max:10|unique:lecturers,phone',
                    'email' => 'required|email|unique:lecturers,email',
                    'staff_id' => 'required|string|max:20|unique:lecturers,staff_id',
                    'role_id' => 'required|exists:roles,id',
                    'department_id' => 'required|exists:departments,id',
                ], [
                    'email.unique' => 'The email :input has already been taken.',
                    'staff_id.unique' => 'The staff number :input has already been taken.',
                    'phone.unique' => 'The phone number :input has already been taken.',
                ]);

                if ($validator->fails()) {
                    // Log detailed validation errors
                    Log::error('Validation failed for staff: ' . json_encode($staff) . ' Errors: ' . json_encode($validator->errors()->all()));
                    DB::rollBack();             
                    return response()->json(['status' => 'error', 'message' => $validator->errors()->all()], 422);
                }

                // Calculate initials
                $initials = strtoupper(substr($staff['last_name'], 0, 1) . ($staff['middle_name'] ? substr($staff['middle_name'], 0, 1) : '') . substr($staff['first_name'], 0, 1));
                $staff['initials'] = $initials;

                // Create staff
                $createdstaff = Lecturer::create($staff);

                // Prepare user data
                $userData = [
                    'role_id' => $staff['role_id'],
                    'referer_id' => $createdstaff->id,
                    'name' => $staff['first_name'] . ' ' . ($staff['middle_name'] ? $staff['middle_name'] . ' ' : '') . $staff['last_name'],
                    'email' => $staff['email'],
                    'username' => $staff['staff_id'],
                    // 'password' => bcrypt($staff['dob']),
                    'password' => Hash::make($staff['phone']),
                ];
                User::create($userData);
            }

            DB::commit();
            Log::info('Successfully added staff: ' . json_encode($staffs));

            return response()->json(['status' => 'success', 'message' => 'Request sent and Staff added successfully.']);
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Exception during bulk staff addition: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'An error occurred while adding staff.'], 500);
        }
    }

    //todo:  Desttroy Student
    public function destroyStaff(Request $request)
    {
        if ($request->ajax()) {
            $request->validate(['id' => 'required|exists:lecturers,id',]);

            try {
                Lecturer::where('id', $request->id)->update(['is_deleted' => 'Yes']);
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, record removed']);
            } catch (\Exception $e) {
                Log::error('Exception during operation: ' . $e->getMessage());
                return response()->json(['status' => 'error', 'message' => 'Operation failed.'], 500);
            }
        }
        return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
    }

    // TODO: Singly adding staff
    public function updateStaff(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
        }

        try {
            // Validate the input
            $validator = Validator::make($request->all(), [
                'id' => 'required|exists:lecturers,id',
                'first_name' => 'required|string|max:255',
                'middle_name' => 'nullable|string|max:255',
                'last_name' => 'required|string|max:255',
                'dob' => 'required|date',
                'gender' => 'required|string',
                'type' => 'required|string',
                'title' => 'required|string',
                'phone' => 'required|string|max:10|unique:lecturers,phone,' . $request->id,
                'email' => 'required|email|unique:lecturers,email,' . $request->id,
                'staff_id' => 'required|string|max:20|unique:lecturers,staff_id,' . $request->id,
                'role_id' => 'required|exists:roles,id',
                'department_id' => 'required|exists:departments,id',
                
            ]);

            // If validation fails, return JSON response with validation errors
            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'errors' => $validator->errors()->all()], 422);
            }

            $validatedData = $validator->validated();

            // Calculate initials
            $initials = strtoupper(
                substr($validatedData['last_name'], 0, 1) .
                ($validatedData['middle_name'] ? substr($validatedData['middle_name'], 0, 1) : '') .
                substr($validatedData['first_name'], 0, 1)
            );
            $validatedData['initials'] = $initials;

            // Update the record with validated fields
            $updatedStudent = Lecturer::where('id', $validatedData['id'])->update($validatedData);

            if ($updatedStudent) {
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, record updated you can check it out']);
            }

            return response()->json(['status' => 'error', 'message' => 'Sorry! operation failed, data could not be updated'], 500);
        } catch (\Exception $e) {
            Log::error('Exception during operation: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'An error occurred while updating the student.'], 500);
        }
    }

    // Todo: Get lecturers
    public function getAssignedLecturers(Request $request)
    {

    }
}