<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    //


    public function dashboard()
    {
        return view("student.dashboard");
    }

    
    public function examinationNumber()
    {
        return view("student.examination-number");
    }


    //TODO: GET all the session semester courses
    // SELECT sc.id, sc.programme_id, sc.classes_id, sc.course_id, sc.session_semester_id, sc.status,p.programme, c.course, c.course_code, c.course_type FROM session_courses sc INNER JOIN programmes p ON sc.programme_id = p.id INNER JOIN courses c ON sc.course_id = c.id INNER JOIN classes cl ON sc.classes_id = cl.id; 
    public function SemesterCouses(Request $request)
    {
        if ($request->ajax()) {
            $sessionId = $request->session()->get('programme');
            $classId = $request->session()->get('level');
    
            $sql = "SELECT sc.id, c.course, c.course_code
                    FROM session_courses sc
                    INNER JOIN programmes p ON sc.programme_id = p.id
                    INNER JOIN courses c ON sc.course_id = c.id
                    INNER JOIN classes cl ON sc.classes_id = cl.id
                    WHERE p.id = ? AND cl.id = ? AND LOWER(sc.status) = 'mounted' AND sc.is_deleted = 'No'
                    ORDER BY c.course ASC";
    
            $courses = DB::select($sql, [$sessionId, $classId]);
    
            return response()->json(['status' => 'success', 'courses' => $courses]);
        }
    }
}
