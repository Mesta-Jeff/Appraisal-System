<?php

namespace App\Http\Controllers;


use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // list of users
    public function usersAccount(Request $request)
    {
        // Your logic here
        return view('settings.users');
    }

    // Students list
    public function Students(Request $request)
    {
        if ($request->ajax()) {
            $students = DB::table('students as s')
                ->join('programmes as p', 's.programme_id', '=', 'p.id')
                ->join('classes as c', 's.class_id', '=', 'c.id')
                ->select(
                    's.*',
                    'p.programme',
                    'c.class'
                )
                ->where('s.is_deleted', 'No')
                ->orderBy('s.id', 'desc')
                ->get();

            return response()->json(['status' => 'success', 'students' => $students]);
        }

        // Your logic here
        return view('settings.students');
    }


    // BUlk adding of students
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
                    'password' => bcrypt($student['phone']),
                ];
                DB::table('users')->insert($userData);
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




    // list of staff
    public function Staff(Request $request)
    {
        // Your logic here
        return view('settings.staffs');
    }
}