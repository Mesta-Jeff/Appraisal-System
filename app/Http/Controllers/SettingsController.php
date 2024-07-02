<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Course;
use App\Models\Classes;
use App\Models\Faculty;
use App\Models\Department;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{

    //todo: BULK ACTION
    public function bulk_destroy(Request $request)
    {
        if ($request->ajax()) {
            try {

                $ids = $request->input('id');

                $table = $request->input('table');
                foreach ($ids as $id) {
                    DB::table($table)->where('id', $id)->delete();
                }
    
                return response()->json(['status' => 'success', 'message' => 'Records removed successfully']);
            } catch (\Exception $e) {
                Log::error('Exception during operation: ' . $e->getMessage());
                return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
            }
        }
        return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
    }




    //TODO: ANYTHING ABOUT ROLE
    public function roles(Request $request)
    {
        if ($request->ajax()) {
            $roles = Role::all();
            return response()->json(['status' => 'success', 'roles' => $roles]);
        }
        return view('settings.roles');
    }
    public function fetch_roles(Request $request)
    {
        $sortroles = DB::table('roles')->orderBy('role', 'asc')->select('role', 'id')->get();
        return response()->json(['sortroles' => $sortroles]);
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
                return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
            }

            // Check if the role already exists
            $existingRole = Role::where('role', $request->input('role'))->first();
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
                return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
            }
            // Update the record with validated fields
            $updated = Role::where('id', $validator->validated()['id'])->update([
                'role' => $validator->validated()['role'],
                'description' => $validator->validated()['description'],
                'hook' => $validator->validated()['hook'],
            ]);

            if ($updated) {
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, data updated']);
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
            // Validate the request
            $validator = Validator::make($request->all(), [
                'id' => 'required|exists:roles,id',
            ]);
    
            try {
                // Find the role by id and delete it
                $role = Role::find($validator->validated()['id']);
                $role->delete();
    
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, record removed']);
            } catch (\Exception $e) {
                Log::error('Exception during operation: ' . $e->getMessage());
                return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
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
                ->orderBy('p.id', 'desc')
                ->get();
            return response()->json(['status' => 'success', 'permissions' => $permissions]);
        }
        return view('settings.permissions');
    }
    public function fetch_permissions(Request $request)
    {
        $permissions = DB::table('permissions')->orderBy('permission', 'asc')->select('permission', 'permission_key')->get();
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
                return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
            }

            // Check if the record already exists
            $existingPermission = Permission ::where('permission', $request->input('permission'))->first();
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
                return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
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
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, data updated']);
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
            // Validate the request
            $validator = Validator::make($request->all(), [
                'id' => 'required|exists:permissions,id',
            ]);
    
            try {
                $permission = Permission::find($validator->validated()['id']);
                $permission->delete();
    
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, record removed']);
            } catch (\Exception $e) {
                Log::error('Exception during operation: ' . $e->getMessage());
                return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
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
                ->get();
            return response()->json(['status' => 'success', 'departments' => $departments]);
        }
        return view('settings.departments');
    }
    public function fetch_departments(Request $request)
    {
        $departments = DB::table('departments')->orderBy('department', 'asc')->select('department', 'id')->get();
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
                return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
            }

            // Check if already exists
            $existingDepartment = Department::where('department', $request->input('department'))->first();
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
                return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
            }
            // Update the record with validated fields
            $updated = Department::where('id', $validator->validated()['id'])->update([
                'faculty_id' => $validator->validated()['faculty'],
                'description' => $validator->validated()['description'],
                'department' => $validator->validated()['department'],
            ]);

            if ($updated) {
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, data updated']);
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
            // Validate the request
            $validator = Validator::make($request->all(), [
                'id' => 'required|exists:departments,id',
            ]);
    
            try {
                // Find by id and delete it
                $department = Department::find($validator->validated()['id']);
                $department->delete();
    
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, record removed']);
            } catch (\Exception $e) {
                Log::error('Exception during operation: ' . $e->getMessage());
                return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
            }
        }
        return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
    }




    //TODO: FACULTY INFORMATIONNS AND ACTIONS
    public function faculties(Request $request)
    {
        if ($request->ajax()) {
            $facultys = Faculty::all();
            return response()->json(['status' => 'success', 'facultys' => $facultys]);
        }
        return view('settings.faculties');
    }
    public function fetch_faculties(Request $request)
    {
        $faculties = DB::table('faculties')->orderBy('faculty', 'asc')->select('faculty', 'id')->get();
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
                return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
            }

            // Check if already exists
            $existingFaculty = Faculty::where('faculty', $request->input('faculty'))->first();
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
                return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
            }
            // Update the record with validated fields
            $updated = Faculty::where('id', $validator->validated()['id'])->update([
                'faculty' => $validator->validated()['faculty'],
                'description' => $validator->validated()['description'],
            ]);

            if ($updated) {
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, data updated']);
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
            // Validate the request
            $validator = Validator::make($request->all(), [
                'id' => 'required|exists:faculties,id',
            ]);
    
            try {
                // Find the role by id and delete it
                $faculty = Faculty::find($validator->validated()['id']);
                $faculty->delete();
    
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, record removed']);
            } catch (\Exception $e) {
                Log::error('Exception during operation: ' . $e->getMessage());
                return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
            }
        }
        return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
    }

    


    //TODO: ALL ABOUT THE CLASSES
    public function classes(Request $request)
    {
        if ($request->ajax()) {
            $classes = Classes::join('departments as d', 'd.id', '=', 'c.department_id')
                ->select('c.id', 'c.department_id', 'd.department', 'c.name')
                ->from('classes as c')
                ->orderBy('c.id', 'desc')
                ->get();
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
                'classes' => 'required|string',
                'department' => 'required|string',
            ]);

            // If validation fails, return JSON response with validation errors
            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
            }

            // Check if already exists
            $existingClass = Classes::where('name', $request->input('classes'))
                ->where('department_id', $request->input('department'))
                ->first();
                if ($existingClass) {
                    return response()->json(['status' => 'error', 'message' => 'Record already exists, try again with different record'], 422);
                }

            // Save the record with validated fields
            $instance = Classes::create([
                'name' => $validator->validated()['classes'],
                'department_id' => $validator->validated()['department'],
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
    public function updateClass(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
        }

        try {
            // Validate the input
            $validator = Validator::make($request->all(), [
                'department' => 'required|numeric',
                'classes' => 'required|string',
                'id' => 'required|exists:classes,id',
            ]);

            // If validation fails, return JSON response with validation errors
            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
            }
            // Update the record with validated fields
            $updated = Classes::where('id', $validator->validated()['id'])->update([
                'department_id' => $validator->validated()['department'],
                'name' => $validator->validated()['classes'],
            ]);

            if ($updated) {
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, data updated']);
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
            // Validate the request
            $validator = Validator::make($request->all(), [
                'id' => 'required|exists:classes,id',
            ]);
    
            try {
                // Find the role by id and delete it
                $classes = Classes::find($validator->validated()['id']);
                $classes->delete();
    
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, record removed']);
            } catch (\Exception $e) {
                Log::error('Exception during operation: ' . $e->getMessage());
                return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
            }
        }
        return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
    }





    //TODO: ALL ABOUT THE COURSES
    public function courses(Request $request)
    {
        if ($request->ajax()) {
            $courses = Course::join('departments as d', 'd.id', '=', 'c.department_id')
                ->select('c.id', 'c.department_id', 'd.department', 'c.course', 'c.course_code', 'c.course_type', 'c.description')
                ->from('courses as c')
                ->orderBy('c.id', 'desc')
                ->get();
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
                'department' => 'required|string',
                'description' => 'required|string',
            ]);

            // If validation fails, return JSON response with validation errors
            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
            }

            // Check if already exists
            $existingCourse = Course::where('course', $request->input('course'))
                ->where('department_id', $request->input('department'))
                ->first();
                if ($existingCourse) {
                    return response()->json(['status' => 'error', 'message' => 'Record already exists, try again with different record'], 422);
                }

            // Save the record with validated fields
            $instance = Course::create([
                'course' => $validator->validated()['course'],
                'course_type' => $validator->validated()['course-type'],
                'course_code' => $validator->validated()['course-code'],
                'description' => $validator->validated()['description'],
                'department_id' => $validator->validated()['department'],
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
                'department' => 'required|numeric',
                'description' => 'required|string',
                'id' => 'required|exists:courses,id',
            ]);

            // If validation fails, return JSON response with validation errors
            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
            }
            // Update the record with validated fields
            $updated = Course::where('id', $validator->validated()['id'])->update([
                'course' => $validator->validated()['course'],
                'course_type' => $validator->validated()['course-type'],
                'course_code' => $validator->validated()['course-code'],
                'description' => $validator->validated()['description'],
                'department_id' => $validator->validated()['department'],
            ]);

            if ($updated) {
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, data updated']);
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
            // Validate the request
            $validator = Validator::make($request->all(), [
                'id' => 'required|exists:courses,id',
            ]);
    
            try {
                // Find the role by id and delete it
                $courses = Course::find($validator->validated()['id']);
                $courses->delete();
    
                return response()->json(['status' => 'success', 'message' => 'Request sent operation performed successfully, record removed']);
            } catch (\Exception $e) {
                Log::error('Exception during operation: ' . $e->getMessage());
                return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
            }
        }
        return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
    }






    public function systemDictionary(Request $request)
    {
        // Your logic here
        return view('settings.system-dictionary');
    }

    public function AppraisalConnfig(Request $request)
    {
        // Your logic here
        return view('settings.appraisal-configuring');
    }



}
