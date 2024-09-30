<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\Course;
use App\Models\Classes;
use App\Models\Faculty;
use App\Models\Semester;
use App\Models\Sessions;
use App\Models\Programme;
use App\Models\Department;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\SessionCourses;
use App\Models\SessionSemester;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{

    //todo: BULK ACTIONS
    public function bulk_destroy(Request $request)
    {
        if ($request->ajax()) {
            try {
                $ids = $request->input('id');
                $table = $request->input('table');

                // Update the is_deleted column to 'Yes' for the specified IDs
                DB::table($table)->whereIn('id', $ids)->update(['is_deleted' => 'Yes']);

                return response()->json(['status' => 'success', 'message' => 'Records marked as deleted successfully']);
            } catch (\Exception $e) {
                Log::error('Exception during operation: ' . $e->getMessage());
                return response()->json(['status' => 'error', 'message' => 'An error occurred while marking records as deleted.'], 500);
            }
        }
        return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
    }

    // TODO: Bulk update the status
    public function bulk_status(Request $request)
    {
        if ($request->ajax()) {
            try {
                $id = $request->input('id');
                $table = $request->input('table');

                // Fetch the current status for the specified ID
                $currentStatus = DB::table($table)->where('id', $id)->value('status');
                $newStatus = ($currentStatus === 'Active') ? 'InActive' : 'Active';
                DB::table($table)->where('id', $id)->update(['status' => $newStatus]);

                return response()->json(['status' => 'success', 'message' => 'Status has been successfully changed']);
            } catch (\Exception $e) {
                Log::error('Exception during operation: ' . $e->getMessage());
                return response()->json(['status' => 'error', 'message' => 'An error occurred while changing the status of the record'], 500);
            }
        }
        return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
    }


    // Todo: Bulk mount courses
    public function bulk_mount(Request $request)
    {
        if ($request->ajax()) {
            try {
                $id = $request->input('id');
                $table = $request->input('table');

                DB::table($table)->whereIn('id', $id)->update(['status' => 'Mounted']);

                return response()->json(['status' => 'success', 'message' => 'Course Mounted successfully']);
            } catch (\Exception $e) {
                Log::error('Exception during operation: ' . $e->getMessage());
                return response()->json(['status' => 'error', 'message' => 'An error occurred while changing the status of the record'], 500);
            }
        }
        return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
    }




    //TODO: ANYTHING ABOUT ROLE
    public function roles(Request $request)
    {
        if ($request->ajax()) {
            $roles = Role::orderBy('id', 'desc')
                ->where('is_deleted', 'No')
                ->whereRaw('LOWER(role) != ?', ['developer'])
                ->get();

            return response()->json(['status' => 'success', 'roles' => $roles]);
        }

        return view('settings.roles');
    }

    public function fetch_roles(Request $request)
    {
        // Priority order of roles
        $rolePriority = [
            'Developer' => 1,
            'Head QA' => 2,
            'Dean' => 3,
            'Administrator' => 4,
            'HOD' => 5,
            'Officer' => 6,
            'Lecturer' => 7,
            'Student' => 8
        ];

        // Get the current role from the session
        $currentRole = $request->session()->get('role');
        $currentRolePriority = isset($rolePriority[$currentRole]) ? $rolePriority[$currentRole] : 9;
        $filteredRoles = DB::table('roles')
            ->where('is_deleted', 'No')
            ->orderBy('role', 'asc')
            ->select('role', 'id')
            ->get()
            ->filter(function ($role) use ($rolePriority, $currentRolePriority) {
                return isset($rolePriority[$role->role]) && $rolePriority[$role->role] >= $currentRolePriority;
            });

        return response()->json(['roles' => $filteredRoles]);
    }

    
    public function addRole(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
        }

        try {
            // Validate the input
            $validator = Validator::make($request->all(), [
                'role' => 'required|string',
                'description' => 'nullable|string',
                'hook' => 'nullable|string',
            ]);

            // If validation fails, return JSON response with validation errors
            if ($validator->fails()) {
                 return response()->json(['status' => 'error', 'message' => $validator->errors()->all()], 422);
            }

            // Check if the role already exists
            $existingRole = Role::where('role', $request->input('role'))->where('is_deleted','No')->first();
            if ($existingRole) {
                return response()->json(['status' => 'error', 'message' => 'Record already exists, try again with different record'], 422);
            }

            // Save the record with validated fields
            $instance = Role::create([
                'role' => $validator->validated()['role'],
                'description' => $validator->validated()['description'],
                'hook' => $validator->validated()['hook'],
            ]);

            if ($instance->save()) {
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, data saved']);
            }
            return response()->json(['status' => 'error', 'message' => 'Sorry! operation failed, data could not be saved'], 500);
        } catch (\Exception $e) {
            Log::error('Exception during operation: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
    public function updateRole(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
        }

        try {
            // Validate the input
            $validator = Validator::make($request->all(), [
                'role' => 'required|string',
                'description' => 'nullable|string',
                'hook' => 'nullable|string',
                'id' => 'required|exists:roles,id',
            ]);

            // If validation fails, return JSON response with validation errors
            if ($validator->fails()) {
                 return response()->json(['status' => 'error', 'message' => $validator->errors()->all()], 422);
            }
            // Update the record with validated fields
            $updated = Role::where('id', $validator->validated()['id'])->update([
                'role' => $validator->validated()['role'],
                'description' => $validator->validated()['description'],
                'hook' => $validator->validated()['hook'],
            ]);

            if ($updated) {
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, record updated you can check it out']);
            }

            return response()->json(['status' => 'error', 'message' => 'Sorry! operation failed, data could not be updated'], 500);
        } catch (\Exception $e) {
            Log::error('Exception during operation: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function destroyRole(Request $request)
    {
        if ($request->ajax()) {
            $request->validate(['id' => 'required|exists:roles,id',]);

            try {
                Role::where('id', $request->id)->update(['is_deleted' => 'Yes']);
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, record removed']);
            } catch (\Exception $e) {
                Log::error('Exception during operation: ' . $e->getMessage());
                return response()->json(['status' => 'error', 'message' => 'Operation failed.'], 500);
            }
        }
        return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
    }
    // ======================================



    //TODO: ANYTHING ABOUT PERMISSIONS
    public function permissions(Request $request)
    {
        if ($request->ajax()) {
            $permissions = Permission::join('roles as r', 'r.id', '=', 'p.role_id')
                ->select('p.id', 'p.role_id', 'r.role', 'p.permission', 'p.permission_key', 'p.description', 'p.hook')
                ->from('permissions as p')
                ->where('p.is_deleted', 'No')
                ->orderBy('p.id', 'desc')
                ->get();
            return response()->json(['status' => 'success', 'permissions' => $permissions]);
        }
        return view('settings.permissions');
    }
    public function fetch_permissions(Request $request)
    {
        $permissions = DB::table('permissions')->where('is_deleted', 'No')->orderBy('permission', 'asc')->select('permission', 'permission_key')->get();
        return response()->json(['permissions' => $permissions]);
    }
    public function addPermission(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
        }

        try {
            // Validate the input
            $validator = Validator::make($request->all(), [
                'permission' => 'required|string',
                'perm' => 'required|string',
                'role' => 'required|string',
                'description' => 'nullable|string',
                'hook' => 'nullable|string',
            ]);

            // If validation fails, return JSON response with validation errors
            if ($validator->fails()) {
                 return response()->json(['status' => 'error', 'message' => $validator->errors()->all()], 422);
            }

            // Check if the record already exists
            $existingPermission = Permission ::where('permission', $request->input('permission'))->where('is_deleted','No')->first();
            if ($existingPermission) {
                return response()->json(['status' => 'error', 'message' => 'Record already exists, try again with different record'], 422);
            }

            // Save the record with validated fields
            $instance = Permission ::create([
                'role_id' => $validator->validated()['role'],
                'description' => $validator->validated()['description'],
                'hook' => $validator->validated()['hook'],
                'permission_key' => $validator->validated()['permission'],
                'permission' => $validator->validated()['perm'],
            ]);

            if ($instance->save()) {
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, data saved']);
            }
            return response()->json(['status' => 'error', 'message' => 'Sorry! operation failed, data could not be saved'], 500);
        } catch (\Exception $e) {
            Log::error('Exception during operation: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
    public function updatePermission(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
        }

        try {
            // Validate the input
            $validator = Validator::make($request->all(), [
                'permission' => 'required|string',
                'perm' => 'required|string',
                'role' => 'required|numeric',
                'description' => 'nullable|string',
                'hook' => 'nullable|string',
                'id' => 'required|exists:permissions,id',
            ]);

            // If validation fails, return JSON response with validation errors
            if ($validator->fails()) {
                 return response()->json(['status' => 'error', 'message' => $validator->errors()->all()], 422);
            }

            // Update the record with validated fields
            $updated = Permission::where('id', $validator->validated()['id'])->update([
                'role_id' => $validator->validated()['role'],
                'description' => $validator->validated()['description'],
                'hook' => $validator->validated()['hook'],
                'permission_key' => $validator->validated()['permission'],
                'permission' => $validator->validated()['perm'],
            ]);

            if ($updated) {
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, record updated you can check it out']);
            }
            return response()->json(['status' => 'error', 'message' => 'Sorry! operation failed, data could not be saved'], 500);
        } catch (\Exception $e) {
            Log::error('Exception during operation: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
    public function destroyPermission(Request $request)
    {
        if ($request->ajax()) {
            $request->validate(['id' => 'required|exists:permissions,id',]);

            try {
                Permission::where('id', $request->id)->update(['is_deleted' => 'Yes']);
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, record removed']);
            } catch (\Exception $e) {
                Log::error('Exception during operation: ' . $e->getMessage());
                return response()->json(['status' => 'error', 'message' => 'Operation failed.'], 500);
            }
        }
        return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
    }


    //TODO: ALL ABOUT DEPARTMENT
    public function departments(Request $request)
    {
        if ($request->ajax()) {
            $departments = Department::join('faculties as f', 'f.id', '=', 'd.faculty_id')
                ->select('d.id', 'd.faculty_id', 'f.faculty', 'd.department', 'd.description')
                ->from('departments as d')
                ->orderBy('d.id', 'desc')
                ->where('d.is_deleted', 'No')
                ->get();
            return response()->json(['status' => 'success', 'departments' => $departments]);
        }
        return view('settings.departments');
    }

    public function fetch_departments(Request $request)
    {
        // Get the current role and necessary session details
        $currentRole = $request->session()->get('role');
        $departmentId = $request->session()->get('department');
        $facultyId = $request->session()->get('faculty');

        // Initialize the query
        $query = DB::table('departments')->where('is_deleted', 'No');

        // Apply role-based filtering
        if (in_array($currentRole, ['HOD', 'Officer'])) {
            $query->where('id', $departmentId); 
        } elseif (in_array($currentRole, ['Dean', 'Administrator'])) {
            $query->where('faculty_id', $facultyId); 
        }

        // Execute the query and get the results
        $departments = $query->orderBy('department', 'asc')->select('department', 'id')->get();

        return response()->json(['departments' => $departments]);
    }

    public function fetch_departmentInfaculty(Request $request)
    {
        // Get the current role and necessary session details
        $currentRole = $request->session()->get('role');
        $departmentId = $request->session()->get('department');
        $facultyId = $request->session()->get('faculty');

        // Initialize the query
        $query = DB::table('departments')->where('is_deleted', 'No');

        // Apply role-based filtering
        if (in_array($currentRole, ['Dean', 'Administrator', 'HOD', 'Officer'])) {
            $query->where('faculty_id', $facultyId); 
        }

        // Execute the query and get the results
        $departments = $query->orderBy('department', 'asc')->select('department', 'id')->get();

        return response()->json(['departments' => $departments]);
    }

    public function addDepartment(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
        }

        try {
            // Validate the input
            $validator = Validator::make($request->all(), [
                'faculty' => 'required|string',
                'department' => 'required|string',
                'description' => 'nullable|string',
            ]);

            // If validation fails, return JSON response with validation errors
            if ($validator->fails()) {
                 return response()->json(['status' => 'error', 'message' => $validator->errors()->all()], 422);
            }

            // Check if already exists
            $existingDepartment = Department::where('department', $request->input('department'))->where('is_deleted','No')->first();
            if ($existingDepartment) {
                return response()->json(['status' => 'error', 'message' => 'Record already exists, try again with different record'], 422);
            }

            // Save the record with validated fields
            $instance = Department::create([
                'faculty_id' => $validator->validated()['faculty'],
                'description' => $validator->validated()['description'],
                'department' => $validator->validated()['department'],
            ]);

            if ($instance->save()) {
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, data saved']);
            }
            return response()->json(['status' => 'error', 'message' => 'Sorry! operation failed, data could not be saved'], 500);
        } catch (\Exception $e) {
            Log::error('Exception during operation: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
    public function updateDepartment(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
        }

        try {
            // Validate the input
            $validator = Validator::make($request->all(), [
                'faculty' => 'required|string',
                'department' => 'required|string',
                'description' => 'nullable|string',
                'id' => 'required|exists:departments,id',
            ]);

            // If validation fails, return JSON response with validation errors
            if ($validator->fails()) {
                 return response()->json(['status' => 'error', 'message' => $validator->errors()->all()], 422);
            }
            // Update the record with validated fields
            $updated = Department::where('id', $validator->validated()['id'])->update([
                'faculty_id' => $validator->validated()['faculty'],
                'description' => $validator->validated()['description'],
                'department' => $validator->validated()['department'],
            ]);

            if ($updated) {
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, record updated you can check it out']);
            }

            return response()->json(['status' => 'error', 'message' => 'Sorry! operation failed, data could not be updated'], 500);
        } catch (\Exception $e) {
            Log::error('Exception during operation: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
    public function destroyDepartment(Request $request)
    {
        if ($request->ajax()) {
            $request->validate(['id' => 'required|exists:departments,id',]);

            try {
                Department::where('id', $request->id)->update(['is_deleted' => 'Yes']);
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, record removed']);
            } catch (\Exception $e) {
                Log::error('Exception during operation: ' . $e->getMessage());
                return response()->json(['status' => 'error', 'message' => 'Operation failed.'], 500);
            }
        }
        return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
    }

    //TODO: PROGRAMMES ACTIONS
    public function programmes(Request $request)
    {
        if ($request->ajax()) {
            $currentRole = $request->session()->get('role');
            $departmentId = $request->session()->get('department');
            $facultyId = $request->session()->get('faculty');

            $programmes = Programme::join('programmes as f', 'd.id', '=', 'f.department_id')
                ->select('f.id', 'f.department_id', 'f.programme', 'd.department', 'f.description', 'f.duration')
                ->from('departments as d')
                // Apply role-based filtering
            ->when(in_array($currentRole, ['HOD', 'Officer']), function ($query) use ($departmentId) {
                return $query->where('d.id', $departmentId);
            })
            ->when(in_array($currentRole, ['Dean', 'Administrator']), function ($query) use ($facultyId) {
                return $query->where('d.faculty_id', $facultyId);
            })
                ->orderBy('d.id', 'desc')
                ->where('f.is_deleted', 'No')->get();
            return response()->json(['status' => 'success', 'programmes' => $programmes]);
        }
        return view('settings.programme');
    }

    public function addProgramme(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
        }

        try {
            // Validate the input
            $validator = Validator::make($request->all(), [
                'department' => 'required|string',
                'programme' => 'required|string',
                'duration' => 'required|string',
                'description' => 'nullable|string',
            ]);

            // If validation fails, return JSON response with validation errors
            if ($validator->fails()) {
                 return response()->json(['status' => 'error', 'message' => $validator->errors()->all()], 422);
            }

            // Check if already exists
            $existingDepartment = Programme::where('programme', $request->input('programme'))->where('is_deleted','No')->first();
            if ($existingDepartment) {
                return response()->json(['status' => 'error', 'message' => 'Record already exists, try again with different record'], 422);
            }

            // Save the record with validated fields
            $instance = Programme::create([
                'department_id' => $validator->validated()['department'],
                'description' => $validator->validated()['description'],
                'duration' => $validator->validated()['duration'],
                'programme' => $validator->validated()['programme'],
            ]);

            if ($instance->save()) {
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, data saved']);
            }
            return response()->json(['status' => 'error', 'message' => 'Sorry! operation failed, data could not be saved'], 500);
        } catch (\Exception $e) {
            Log::error('Exception during operation: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function updateProgramme(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
        }

        try {
            // Validate the input
            $validator = Validator::make($request->all(), [
                'department' => 'required|string',
                'programme' => 'required|string',
                'duration' => 'required|string',
                'description' => 'nullable|string',
                'id' => 'required|exists:programmes,id',
            ]);

            // If validation fails, return JSON response with validation errors
            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'errors' => $validator->errors()->all()], 422);
            }
            // Update the record with validated fields
            $updated = Programme::where('id', $validator->validated()['id'])->update([
                'department_id' => $validator->validated()['department'],
                'description' => $validator->validated()['description'],
                'duration' => $validator->validated()['duration'],
                'programme' => $validator->validated()['programme'],
            ]);

            if ($updated) {
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, record updated you can check it out']);
            }

            return response()->json(['status' => 'error', 'message' => 'Sorry! operation failed, data could not be updated'], 500);
        } catch (\Exception $e) {
            Log::error('Exception during operation: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function destroyProgramme(Request $request)
    {
        if ($request->ajax()) {
            $request->validate(['id' => 'required|exists:programmes,id',]);

            try {
                Programme::where('id', $request->id)->update(['is_deleted' => 'Yes']);
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, record removed']);
            } catch (\Exception $e) {
                Log::error('Exception during operation: ' . $e->getMessage());
                return response()->json(['status' => 'error', 'message' => 'Operation failed.'], 500);
            }
        }
        return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
    }

    public function fetchProgrammes(Request $request)
    {
        // Get the current role and necessary session details
        $currentRole = $request->session()->get('role');
        $departmentId = $request->session()->get('department');
        $facultyId = $request->session()->get('faculty');

        $programmes = DB::table('programmes as p')
            ->join('departments as d', 'p.department_id', '=', 'd.id')
            ->where('p.is_deleted', 'No')
            // Apply role-based filtering
            ->when(in_array($currentRole, ['HOD', 'Officer']), function ($query) use ($departmentId) {
                return $query->where('d.id', $departmentId);
            })
            ->when(in_array($currentRole, ['Dean', 'Administrator']), function ($query) use ($facultyId) {
                return $query->where('d.faculty_id', $facultyId);
            })
            ->select('p.programme', 'p.id')->orderBy('p.programme', 'asc')->get();

        return response()->json(['programmes' => $programmes]);
    }

    public function fetchDepartmentProgrammes(Request $request)
    {
        $programmes = DB::table('programmes')->where('is_deleted', 'No')->where('department_id', $request->input('department_id'))->orderBy('programme', 'asc')->select('programme', 'id')->get();
        return response()->json(['programmes' => $programmes]);
    }


    //TODO: SEMESTER ACTIONS
    public function semesters(Request $request)
    {
        if ($request->ajax()) {
            $semesters = Semester::orderBy('id', 'desc')->where('is_deleted','No')->get();
            return response()->json(['status' => 'success', 'semesters' => $semesters]);
        }
        return view('settings.semester');
    }

    public function addSemester(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
        }

        try {
            // Validate the input
            $validator = Validator::make($request->all(), [
                'semester' => 'required|string',
                'description' => 'nullable|string',
            ]);
            

            // If validation fails, return JSON response with validation errors
            if ($validator->fails()) {
                 return response()->json(['status' => 'error', 'message' => $validator->errors()->all()], 422);
            }
            $data = $validator->validated();

            // Check if already exists
            $existingFaculty = Semester::where('semester', $request->input('semester'))->where('is_deleted','No')->first();
            if ($existingFaculty) {
                return response()->json(['status' => 'error', 'message' => 'Same semester has been created already, try again with different record'], 422);
            }

            // Save the record with validated fields
            $instance = Semester::create($data);

            if ($instance->save()) {
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, semester created']);
            }
            return response()->json(['status' => 'error', 'message' => 'Sorry! operation failed, data could not be saved'], 500);
        } catch (\Exception $e) {
            Log::error('Exception during operation: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function updateSemester(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
        }

        try {
            // Validate the input
            $validator = Validator::make($request->all(), [
                'semester' => 'required|string',
                'description' => 'nullable|string',
                'id' => 'required|exists:semesters,id',
            ]);

            // If validation fails, return JSON response with validation errors
            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'message' => $validator->errors()->all()], 422);
            }

            // Get validated data
            $data = $validator->validated();
            
            // Update the record with validated fields
            $updated = Semester::where('id', $data['id'])->update($data);

            if ($updated) {
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, record updated you can check it out']);
            }

            return response()->json(['status' => 'error', 'message' => 'Sorry! operation failed, data could not be updated'], 500);
        } catch (\Exception $e) {
            Log::error('Exception during operation: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function destroySemester(Request $request)
    {
        if ($request->ajax()) {
            $request->validate(['id' => 'required|exists:semesters,id',]);

            try {
                Semester::where('id', $request->id)->update(['is_deleted' => 'Yes']);
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, record marked as deleted']);
            } catch (\Exception $e) {
                Log::error('Exception during operation: ' . $e->getMessage());
                return response()->json(['status' => 'error', 'message' => 'Operation failed.'], 500);
            }
        }
        return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
    }

    public function fetchSemesters(Request $request)
    {
        $semesters = DB::table('semesters')->where('is_deleted', 'No')->orderBy('semester', 'asc')->select('semester', 'id')->limit(2)->get();
        return response()->json(['semesters' => $semesters]);
    }


    //TODO: SESSIONS OR THE ACADEMIC YEAR
    public function sessions(Request $request)
    {
        if ($request->ajax()) {
            $sessions = Sessions::orderBy('id', 'desc')->where('is_deleted','No')->get();
            return response()->json(['status' => 'success', 'sessions' => $sessions]);
        }
        return view('settings.sessions');
    }

    public function addSession(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
        }
    
        try {
            // Validate the input
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'begins' => 'required|date|after_or_equal:today',
                'ends' => 'required|date|after:begins',
                'description' => 'nullable|string',
            ]);
    
            // If validation fails, return JSON response with validation errors
            if ($validator->fails()) {
                 return response()->json(['status' => 'error', 'message' => $validator->errors()->all()], 422);
            }
    
            // Get validated data
            $data = $validator->validated();
            // Check if already exists
            $existingSession = Sessions::where('name', $request->input('name'))->where('is_deleted','No')->first();
            if ($existingSession) {
                return response()->json(['status' => 'error', 'message' => 'Similar Academic year has is on already, unmount it before you can mount this academic year'], 422);
            }
    
            // Save the record with validated fields
            $instance = Sessions::create($data);
    
            if ($instance) {
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, academic year mounted']);
            }
    
            return response()->json(['status' => 'error', 'message' => 'Sorry! operation failed, session could not be mounted'], 500);
        } catch (\Exception $e) {
            Log::error('Exception during operation: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
    
    public function updateSession(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
        }

        try {
            // Validate the input
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'begins' => 'required|date|after_or_equal:today',
                'ends' => 'required|date|after:begins',
                'description' => 'nullable|string',
                'id' => 'required|exists:sessions,id',
            ]);

            // If validation fails, return JSON response with validation errors
            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'errors' => $validator->errors()->all()], 422);
            }

            // Get validated data
            $data = $validator->validated();
            
            // Update the record with validated fields
            $updated = Sessions::where('id', $data['id'])->update($data);

            if ($updated) {
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, record updated you can check it out']);
            }

            return response()->json(['status' => 'error', 'message' => 'Sorry! operation failed, data could not be updated'], 500);
        } catch (\Exception $e) {
            Log::error('Exception during operation: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function destroySession(Request $request)
    {
        if ($request->ajax()) {
            $request->validate(['id' => 'required|exists:sessions,id',]);

            try {
                Sessions::where('id', $request->id)->update(['is_deleted' => 'Yes']);
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, record marked as deleted']);
            } catch (\Exception $e) {
                Log::error('Exception during operation: ' . $e->getMessage());
                return response()->json(['status' => 'error', 'message' => 'Operation failed.'], 500);
            }
        }
        return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
    }

    public function fetchSessions(Request $request)
    {
        $now = now();
        $threeMonthsFromNow = $now->addMonths(3);

        $sessions = DB::table('sessions')
        ->where('is_deleted', 'No')
        ->where('status', 'Active')
        ->where('begins', '<=', $threeMonthsFromNow)
        ->orderBy('begins', 'asc')->select('name', 'id')->limit(1)->get();

        return response()->json(['sessions' => $sessions]);
    }


    //TODO:  SEMESTER SESSION
    public function sessionSemester(Request $request)
    {
        $encodedData = $request->query('id');
        $title = '';
        $id = '';

        if ($encodedData) {
            $data = json_decode(base64_decode($encodedData), true);
            $id = $data['id'];
            $title = $data['title']; 
        }
        
        if ($request->ajax()) {
            $keys = $request->input('keys');
            // Log::info('IKEY: '. $keys);
            $sessionSemesters = SessionSemester::join('semesters as s', 'ss.semester_id', '=', 's.id')
                ->join('sessions as se', 'ss.session_id', '=', 'se.id')
                ->select('ss.id', 'ss.session_id', 'ss.begins', 'ss.ends', 's.semester', 'ss.semester_id', 'ss.description', 'se.name', 'ss.status')
                ->from('session_semesters as ss')
                ->where('ss.is_deleted', 'No')
                ->where('ss.session_id', $keys)
                ->get();
            return response()->json(['status' => 'success', 'semesters' => $sessionSemesters]);
        }
        
        if ($encodedData) {
            return view('settings/session-semester', ['title' => $title, 'session_id' => $id]);
        } else {
            return view('settings/sessions');
        }
    }

    public function addSessionSemester(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
        }

        try {
            // Validate the input
            $validator = Validator::make($request->all(), [
                'semester_id' => 'required|exists:semesters,id',
                'session_id' => 'required|exists:sessions,id',
                'begins' => 'required|date|after_or_equal:today',
                'ends' => 'required|date|after:begins',
                'description' => 'nullable|string',
            ]);

            // If validation fails, return JSON response with validation errors
            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'message' => $validator->errors()->all()], 422);
            }

            // Get validated data
            $data = $validator->validated();

            // Retrieve the session begins date
            $session = Sessions::find($data['session_id']);
            if ($data['begins'] < $session->begins) {
                return response()->json(['status' => 'error', 'message' => 'Semester cannot start before the academic year'], 422);
            }

            // Check if a similar record already exists
            $existingSemester = SessionSemester::where('semester_id', $data['semester_id'])->where('begins', $data['begins'])->where('is_deleted','No')->first();

            if ($existingSemester) {
                return response()->json(['status' => 'error', 'message' => 'Semester has been created already, no need to recreate'], 422);
            }

            // Check if there are ongoing semesters that haven't ended
            $currentSemester = SessionSemester::where('session_id', $data['session_id'])->where('ends', '>', now())->orderBy('ends', 'desc')->where('is_deleted','No')->first();

            if ($currentSemester) {
                $currentSemesterEnds = Carbon::parse($currentSemester->ends);
                if ($currentSemesterEnds->diffInDays(now()) > 30) {
                    return response()->json(['status' => 'error', 'message' => 'Sorry, you cannot create a new semester while the current semester has not ended. You can only create a new semester when it is within a month of the current semester ending or after it has ended.'], 422);
                }
            }

            // Save the record with validated fields
            $instance = SessionSemester::create($data);

            if ($instance) {
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, session mounted']);
            }

            return response()->json(['status' => 'error', 'message' => 'Sorry! Operation failed, session could not be mounted'], 500);
        } catch (\Exception $e) {
            Log::error('Exception during operation: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function updateSessionSemester(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
        }

        try {
            // Validate the input
            $validator = Validator::make($request->all(), [
                'begins' => 'required|date|after_or_equal:today',
                'ends' => 'required|date|after:begins',
                'description' => 'nullable|string',
                'id' => 'required|exists:session_semesters,id',
            ]);

            // If validation fails, return JSON response with validation errors
            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'errors' => $validator->errors()->all()], 422);
            }

            // Get validated data
            $data = $validator->validated();
            
            // Update the record with validated fields
            $updated = SessionSemester::where('id', $data['id'])->update($data);

            if ($updated) {
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, record updated you can check it out']);
            }

            return response()->json(['status' => 'error', 'message' => 'Sorry! operation failed, data could not be updated'], 500);
        } catch (\Exception $e) {
            Log::error('Exception during operation: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function destroySessionSemester(Request $request)
    {
        if ($request->ajax()) {
            $request->validate(['id' => 'required|exists:session_semesters,id',]);

            try {
                SessionSemester::where('id', $request->id)->update(['is_deleted' => 'Yes']);
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, record marked as deleted']);
            } catch (\Exception $e) {
                Log::error('Exception during operation: ' . $e->getMessage());
                return response()->json(['status' => 'error', 'message' => 'Operation failed.'], 500);
            }
        }
        return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
    }

    public function fetchSessionSemesters(Request $request)
    {
        $sessionSemesters = SessionSemester::join('semesters as s', 'ss.semester_id', '=', 's.id')
            ->join('sessions as se', 'ss.session_id', '=', 'se.id')->select('ss.id', 's.semester')
            ->from('session_semesters as ss')
            ->where('ss.is_deleted', 'No')->where('ss.session_id', $request->input('session_id'))->get();

        return response()->json(['status' => 'success', 'semesters' => $sessionSemesters]);
    }



    //TODO: SESSION COURSES
    public function sessionCourse(Request $request)
    {
        if ($request->ajax()) {

            $currentRole = $request->session()->get('role');
            $departmentId = $request->session()->get('department');
            $facultyId = $request->session()->get('faculty');

            $sessionCourses = SessionCourses::select(
                DB::raw('p.programme, l.class, c.course, c.course_code, s.semester, sc.status, sc.id')
            )
            ->join('session_semesters as ss', 'ss.id', '=', 'sc.session_semester_id')
            ->join('courses as c', 'c.id', '=', 'sc.course_id')
            ->join('classes as l', 'l.id', '=', 'sc.classes_id')
            ->join('programmes as p', 'p.id', '=', 'sc.programme_id')
            ->join('semesters as s', 's.id', '=', 'ss.semester_id')
            ->leftJoin('departments as d', 'p.department_id', '=', 'd.id')
            ->from('session_courses as sc')
            ->where('sc.is_deleted', 'No')
            ->where('sc.status', '!=', 'InActive')
            ->when(in_array($currentRole, ['HOD', 'Officer']), function ($query) use ($departmentId) {
                return $query->where('d.id', $departmentId);
            })
            ->when(in_array($currentRole, ['Dean', 'Administrator']), function ($query) use ($facultyId) {
                return $query->where('d.faculty_id', $facultyId);
            })
            ->orderBy('l.class', 'ASC')->orderBy('c.course', 'ASC')->get();

            return response()->json(['status' => 'success', 'sessionCourses' => $sessionCourses]);
        }

        return view('settings.session-course');
    }

    public function addSessionCourse(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
        }

        try {
            // Validate the input
            $validator = Validator::make($request->all(), [
                'semester' => 'required|exists:session_semesters,id',
                'level' => 'required|exists:classes,id',
                'programme' => 'required|exists:programmes,id',
                'course' => 'required|array',
                'course.*' => 'exists:courses,id',
                'description' => 'nullable|string',
            ]);

            // If validation fails, return JSON response with validation errors
            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'message' => $validator->errors()->all()], 422);
            }

            // Get validated data
            $data = $validator->validated();

            // Loop through each course and insert individually
            foreach ($data['course'] as $courseId) {
                $sessionCourseData = [
                    'session_semester_id' => $data['semester'],
                    'classes_id' => $data['level'],
                    'programme_id' => $data['programme'],
                    'course_id' => $courseId,
                    'description' => $data['description'] ?? null,
                ];

                // Check if the course is already mounted
                $existingCourse = SessionCourses::where('course_id', $courseId)
                    ->where('session_semester_id', $data['semester'])->where('classes_id', $data['level'])->where('programme_id', $data['programme'])->where('status', 'Mounted')->where('is_deleted','No')->first();

                if ($existingCourse) {
                    return response()->json(['status' => 'error', 'message' => 'Course has been already mounted for this this semester'], 422);
                }

                // Create a new session course
                SessionCourses::create($sessionCourseData);
            }

            return response()->json(['status' => 'success', 'message' => 'Request sent, operation performed successfully, courses mounted']);
        } catch (\Exception $e) {
            Log::error('Exception during operation: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function unmount_course(Request $request)
    {
        if ($request->ajax()) {
            $request->validate(['id' => 'required|exists:session_courses,id',]);

            try {
                SessionCourses::where('id', $request->id)->update(['status' => 'Unmounted']);
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, record removed']);
            } catch (\Exception $e) {
                Log::error('Exception during operation: ' . $e->getMessage());
                return response()->json(['status' => 'error', 'message' => 'Operation failed.'], 500);
            }
        }
        return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
    }

    public function fetchSessionCourses(Request $request)
    {
        if ($request->ajax()) {

            $currentRole = $request->session()->get('role');
            $departmentId = $request->session()->get('department');
            $facultyId = $request->session()->get('faculty');

            $courses = DB::table('courses as c')
                ->select('sc.id', 'c.course')
                ->join('programmes as p', 'c.programme_id', '=', 'p.id') 
                ->join('departments as d', 'p.department_id', '=', 'd.id')
                ->join('session_courses as sc', 'c.id', '=', 'sc.course_id')
                
                // Filter only when the course type is departmental for HOD and Officer
               
                ->when(in_array($currentRole, ['HOD', 'Officer']), function ($query) use ($departmentId) {
                    return $query->where(function ($query) use ($departmentId) {
                        $query->where('d.id', $departmentId)->whereRaw('LOWER(c.course_type) = ?', ['departmental']);
                    });
                })
                ->orWhereRaw('LOWER(c.course_type) != ?', ['departmental'])
                ->orWhere(function ($query) use ($departmentId) {
                    $query->where('d.id', '!=', $departmentId);
                })
                
                // Leave the Dean and Administrator logic unchanged
                ->when(in_array($currentRole, ['Dean', 'Administrator']), function ($query) use ($facultyId) {
                    return $query->where('d.faculty_id', $facultyId);
                })

                // Add logic for 'faculty' course type to check if the programme belongs to the session's department
                ->when(in_array($currentRole, ['HOD', 'Officer']), function ($query) use ($departmentId) {
                    return $query->where(function ($query) use ($departmentId) {
                        $query->whereRaw('LOWER(c.course_type) = ?', ['faculty'])->whereRaw('FIND_IN_SET(?, c.accessors)', [$departmentId]);
                    });
                })
                
                ->where('c.programme_id', $request->input('programme_id'))
                ->where('c.is_deleted', 'No')
                ->where('p.is_deleted', 'No')
                ->where('d.is_deleted', 'No')
                ->where('sc.status', '!=', 'InActive')
                ->where('sc.is_deleted', 'No')
                ->orderBy('c.id', 'desc')
                ->get();
        //    Log::info('Courses Data:', ['courses' => $courses->toArray()]);

            return response()->json(['status' => 'success', 'courses' => $courses]);
        }

    }


    


    //TODO: FACULTY INFORMATIONNS AND ACTIONS
    public function faculties(Request $request)
    {
        if ($request->ajax()) {
            $faculties = Faculty::where('is_deleted','No')->orderBy('id', 'desc')->get();
            return response()->json(['status' => 'success', 'facultys' => $faculties]);
        }
        return view('settings.faculties');
    }
    public function fetch_faculties(Request $request)
    {
        $faculties = DB::table('faculties')->where('is_deleted', 'No')->orderBy('faculty', 'asc')->select('faculty', 'id')->get();
        return response()->json(['faculties' => $faculties]);
    }
    public function addFaculty(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
        }

        try {
            // Validate the input
            $validator = Validator::make($request->all(), [
                'faculty' => 'required|string',
                'description' => 'nullable|string',
            ]);

            // If validation fails, return JSON response with validation errors
            if ($validator->fails()) {
                 return response()->json(['status' => 'error', 'message' => $validator->errors()->all()], 422);
            }

            // Check if already exists
            $existingFaculty = Faculty::where('faculty', $request->input('faculty'))->where('is_deleted','No')->first();
            if ($existingFaculty) {
                return response()->json(['status' => 'error', 'message' => 'Record already exists, try again with different record'], 422);
            }

            // Save the record with validated fields
            $instance = Faculty::create([
                'faculty' => $validator->validated()['faculty'],
                'description' => $validator->validated()['description'],
            ]);

            if ($instance->save()) {
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, data saved']);
            }
            return response()->json(['status' => 'error', 'message' => 'Sorry! operation failed, data could not be saved'], 500);
        } catch (\Exception $e) {
            Log::error('Exception during operation: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
    public function updateFaculty(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
        }

        try {
            // Validate the input
            $validator = Validator::make($request->all(), [
                'faculty' => 'required|string',
                'description' => 'nullable|string',
                'id' => 'required|exists:faculties,id',
            ]);

            // If validation fails, return JSON response with validation errors
            if ($validator->fails()) {
                 return response()->json(['status' => 'error', 'message' => $validator->errors()->all()], 422);
            }
            // Update the record with validated fields
            $updated = Faculty::where('id', $validator->validated()['id'])->update([
                'faculty' => $validator->validated()['faculty'],
                'description' => $validator->validated()['description'],
            ]);

            if ($updated) {
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, record updated you can check it out']);
            }

            return response()->json(['status' => 'error', 'message' => 'Sorry! operation failed, data could not be updated'], 500);
        } catch (\Exception $e) {
            Log::error('Exception during operation: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
    public function destroyFaculty(Request $request)
    {
        if ($request->ajax()) {
            $request->validate(['id' => 'required|exists:faculties,id',]);

            try {
                Faculty::where('id', $request->id)->update(['is_deleted' => 'Yes']);
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, record removed']);
            } catch (\Exception $e) {
                Log::error('Exception during operation: ' . $e->getMessage());
                return response()->json(['status' => 'error', 'message' => 'Operation failed.'], 500);
            }
        }
        return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
    }
  

    //TODO: ALL ABOUT THE CLASSES
    public function classes(Request $request)
    {
        if ($request->ajax()) {
            $classes = Classes::where('is_deleted','No')->orderBy('id', 'desc')->get();
            return response()->json(['status' => 'success', 'classes' => $classes]);
        }
        return view('settings.classes');
    }
    
    public function addClass(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
        }

        try {
            // Validate the input
            $validator = Validator::make($request->all(), [
                'classes' => 'required|string"',
            ]);

            // If validation fails, return JSON response with validation errors
            if ($validator->fails()) {
                 return response()->json(['status' => 'error', 'message' => $validator->errors()->all()], 422);
            }

            // Check if already exists
            $existingClass = Classes::where('class', $request->input('classes'))->where('is_deleted','No')->first();
                if ($existingClass) {
                    return response()->json(['status' => 'error', 'message' => 'Class already exists, try again with different record'], 422);
                }

            // Save the record with validated fields
            $instance = Classes::create([
                'class' => $validator->validated()['classes'],
            ]);

            if ($instance->save()) {
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, class created']);
            }
            return response()->json(['status' => 'error', 'message' => 'Sorry! operation failed, data could not be saved'], 500);
        } catch (\Exception $e) {
            Log::error('Exception during operation: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
    public function updateClass(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
        }

        try {
            // Validate the input
            $validator = Validator::make($request->all(), [
                'classes' => 'required|string',
                'id' => 'required|exists:classes,id',
            ]);

            // If validation fails, return JSON response with validation errors
            if ($validator->fails()) {
                 return response()->json(['status' => 'error', 'message' => $validator->errors()->all()], 422);
            }
            // Update the record with validated fields
            $updated = Classes::where('id', $validator->validated()['id'])->update([
                'class' => $validator->validated()['classes'],
            ]);

            if ($updated) {
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, class updated you can check it out']);
            }

            return response()->json(['status' => 'error', 'message' => 'Sorry! operation failed, data could not be updated'], 500);
        } catch (\Exception $e) {
            Log::error('Exception during operation: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
    public function destroyClass(Request $request)
    {
        if ($request->ajax()) {
            $request->validate(['id' => 'required|exists:classes,id',]);

            try {
                Classes::where('id', $request->id)->update(['is_deleted' => 'Yes']);
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, record removed']);
            } catch (\Exception $e) {
                Log::error('Exception during operation: ' . $e->getMessage());
                return response()->json(['status' => 'error', 'message' => 'Operation failed.'], 500);
            }
        }
        return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
    }
    public function fetchLevels(Request $request)
    {
        $levels = DB::table('classes')->where('is_deleted', 'No')->orderBy('class', 'asc')->select('class', 'id')->get();
        return response()->json(['levels' => $levels]);
    }


    //TODO: ALL ABOUT THE COURSES
    public function courses(Request $request)
    {
        if ($request->ajax()) {

            $currentRole = $request->session()->get('role');
            $departmentId = $request->session()->get('department');
            $facultyId = $request->session()->get('faculty');

            $courses = DB::table('courses as c')
                ->select('c.id', 'c.programme_id','p.department_id', 'p.programme', 'c.course', 'c.course_code', 'c.course_type', 'c.description', 'c.accessors')
                ->join('programmes as p', 'c.programme_id', '=', 'p.id') 
                ->join('departments as d', 'p.department_id', '=', 'd.id')
                
                // Filter only when the course type is departmental for HOD and Officer
               
                ->when(in_array($currentRole, ['HOD', 'Officer']), function ($query) use ($departmentId) {
                    return $query->where(function ($query) use ($departmentId) {
                        $query->where('d.id', $departmentId)
                            ->whereRaw('LOWER(c.course_type) = ?', ['departmental']);
                    });
                })
                ->orWhereRaw('LOWER(c.course_type) != ?', ['departmental'])
                ->orWhere(function ($query) use ($departmentId) {
                    $query->where('d.id', '!=', $departmentId);
                })
                
                // Leave the Dean and Administrator logic unchanged
                ->when(in_array($currentRole, ['Dean', 'Administrator']), function ($query) use ($facultyId) {
                    return $query->where('d.faculty_id', $facultyId);
                })

                // Add logic for 'faculty' course type to check if the programme belongs to the session's department
                ->when(in_array($currentRole, ['HOD', 'Officer']), function ($query) use ($departmentId) {
                    return $query->where(function ($query) use ($departmentId) {
                        $query->whereRaw('LOWER(c.course_type) = ?', ['faculty'])
                            // Check if the department_id exists in the comma-separated accessors string
                            ->whereRaw('FIND_IN_SET(?, c.accessors)', [$departmentId]);
                    });
                })
                
                ->where('c.is_deleted', 'No')
                ->where('p.is_deleted', 'No')
                ->where('d.is_deleted', 'No')
                ->orderBy('c.id', 'desc')
                ->get();

            // Append session values to each course item
            $courses = $courses->map(function ($course) use ($currentRole, $departmentId, $facultyId) {
                $course->role = $currentRole;
                $course->department = $departmentId;
                $course->faculty = $facultyId;
                return $course;
            });

        //    Log::info('Courses Data:', ['courses' => $courses->toArray()]);

            return response()->json(['status' => 'success', 'courses' => $courses]);
        }

        return view('settings.courses');
    }

    public function addCourse(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
        }

        try {
            // Validate the input
            $validator = Validator::make($request->all(), [
                'course' => 'required|string',
                'course-code' => 'required|string',
                'course-type' => 'required|string',
                'programme' => 'required|exists:programmes,id',
                'accessors' => 'nullable|string',
                'description' => 'required|string',
            ]);

            // If validation fails, return JSON response with validation errors
            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'message' => $validator->errors()->all()], 422);
            }

            // Check if already exists
            $existingCourse = Course::where('course', $request->input('course'))
                ->where('course_code', $request->input('course-code'))->where('is_deleted','No')->first();
            if ($existingCourse) {
                return response()->json(['status' => 'error', 'message' => 'Course already exists, try again with a different course code'], 422);
            }

            // Prepare the data for saving
            $validatedData = $validator->validated();
            $courseData = [
                'course' => $validatedData['course'],
                'course_type' => $validatedData['course-type'],
                'course_code' => $validatedData['course-code'],
                'description' => $validatedData['description'],
                'programme_id' => $validatedData['programme'],
            ];

            if (!empty($validatedData['accessors'])) {
                $courseData['accessors'] = $validatedData['accessors'];
            }

            // Save the record with validated fields
            $instance = Course::create($courseData);

            if ($instance->save()) {
                return response()->json(['status' => 'success', 'message' => 'Request sent successfully, course has been created']);
            }
            return response()->json(['status' => 'error', 'message' => 'Sorry! Operation failed, data could not be created'], 500);
        } catch (\Exception $e) {
            Log::error('Exception during operation: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function updateCourse(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
        }

        try {
            // Validate the input
            $validator = Validator::make($request->all(), [
                'course' => 'required|string',
                'course-code' => 'required|string',
                'course-type' => 'required|string',
                'programme' => 'required|exists:programmes,id',
                'accessors' => 'nullable|string',
                'description' => 'required|string',
                'id' => 'required|exists:courses,id',
            ]);

            // If validation fails, return JSON response with validation errors
            if ($validator->fails()) {
                 return response()->json(['status' => 'error', 'message' => $validator->errors()->all()], 422);
            }
            // Update the record with validated fields
            $validatedData = $validator->validated();
            $courseData = [
                'course' => $validatedData['course'],
                'course_type' => $validatedData['course-type'],
                'course_code' => $validatedData['course-code'],
                'description' => $validatedData['description'],
                'programme_id' => $validatedData['programme'],
            ];

            if (!empty($validatedData['accessors'])) {
                $courseData['accessors'] = $validatedData['accessors'];
            }

            // Save the record with validated fields
            $updated = Course::where('id', $validator->validated()['id'])->update($courseData);

            if ($updated) {
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, course updated you can check it out']);
            }

            return response()->json(['status' => 'error', 'message' => 'Sorry! operation failed, data could not be updated'], 500);
        } catch (\Exception $e) {
            Log::error('Exception during operation: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
    public function destroyCourse(Request $request)
    {
        if ($request->ajax()) {
            $request->validate(['id' => 'required|exists:courses,id',]);

            try {
                Course::where('id', $request->id)->update(['is_deleted' => 'Yes']);
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, course has been released']);
            } catch (\Exception $e) {
                Log::error('Exception during operation: ' . $e->getMessage());
                return response()->json(['status' => 'error', 'message' => 'Operation failed.'], 500);
            }
        }
        return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
    }

    // TODO: FETCH COURSE BASE ON PRogramme
    public function fetchProgrammeCourses(Request $request)
    {
        if ($request->ajax()) {

            $currentRole = $request->session()->get('role');
            $departmentId = $request->session()->get('department');
            $facultyId = $request->session()->get('faculty');

            $courses = DB::table('courses as c')
                ->select('c.id', 'c.course')
                ->join('programmes as p', 'c.programme_id', '=', 'p.id') 
                ->join('departments as d', 'p.department_id', '=', 'd.id')
                
                // Filter only when the course type is departmental for HOD and Officer
               
                ->when(in_array($currentRole, ['HOD', 'Officer']), function ($query) use ($departmentId) {
                    return $query->where(function ($query) use ($departmentId) {
                        $query->where('d.id', $departmentId)
                            ->whereRaw('LOWER(c.course_type) = ?', ['departmental']);
                    });
                })
                ->orWhereRaw('LOWER(c.course_type) != ?', ['departmental'])
                ->orWhere(function ($query) use ($departmentId) {
                    $query->where('d.id', '!=', $departmentId);
                })
                
                // Leave the Dean and Administrator logic unchanged
                ->when(in_array($currentRole, ['Dean', 'Administrator']), function ($query) use ($facultyId) {
                    return $query->where('d.faculty_id', $facultyId);
                })

                // Add logic for 'faculty' course type to check if the programme belongs to the session's department
                ->when(in_array($currentRole, ['HOD', 'Officer']), function ($query) use ($departmentId) {
                    return $query->where(function ($query) use ($departmentId) {
                        $query->whereRaw('LOWER(c.course_type) = ?', ['faculty'])
                            // Check if the department_id exists in the comma-separated accessors string
                            ->whereRaw('FIND_IN_SET(?, c.accessors)', [$departmentId]);
                    });
                })
                

                ->where('c.programme_id', $request->input('programme_id'))
                ->where('c.is_deleted', 'No')
                ->where('p.is_deleted', 'No')
                ->where('d.is_deleted', 'No')
                ->orderBy('c.id', 'desc')
                ->get();

            //    Log::info('Courses Data:', ['courses' => $courses->toArray()]);

            return response()->json(['status' => 'success', 'courses' => $courses]);
        }
    }


    public function lecturerCourses(Request $request)
    {
        // Your logic here
        return view('settings.lecturerCourse');
    }

    //assignCourses
    public function assignCourses(Request $request)
    {
        // Your logic here
       
        if (!$request->ajax()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
        }

        try {
            // Validate the input
            $validator = Validator::make($request->all(), [
                'course' => 'required|int',
                'lecturer' => 'required|int',
                'description' => 'required|string',
            ]);

            // If validation fails, return JSON response with validation errors
            if ($validator->fails()) {
                 return response()->json(['status' => 'error', 'message' => $validator->errors()->all()], 422);
            }

            // Check if already exists
            $existingClass = LecturerCourses::where('class', $request->input('classes'))->where('is_deleted','No')->first();
                if ($existingClass) {
                    return response()->json(['status' => 'error', 'message' => 'Class already exists, try again with different record'], 422);
                }

            // Save the record with validated fields
            $instance = Classes::create([
                'class' => $validator->validated()['classes'],
            ]);

            if ($instance->save()) {
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, class created']);
            }
            return response()->json(['status' => 'error', 'message' => 'Sorry! operation failed, data could not be saved'], 500);
        } catch (\Exception $e) {
            Log::error('Exception during operation: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
        
    }





    public function systemDictionary(Request $request)
    {
        // Your logic here
        return view('settings.system-dictionary');
    }



}
