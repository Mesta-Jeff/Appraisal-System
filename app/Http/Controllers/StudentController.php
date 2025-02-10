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
    public function SemesterCouses(Request $request)
    {
        if ($request->ajax()) {
            $sessionId = $request->session()->get('programme');
            $classId = $request->session()->get('level');

            $sql = "SELECT DISTINCT sc.id, c.course, c.course_code
            FROM session_courses sc
            INNER JOIN programmes p ON sc.programme_id = p.id
            INNER JOIN courses c ON sc.course_id = c.id
            INNER JOIN classes cl ON sc.classes_id = cl.id
            INNER JOIN lecturer_courses lc ON lc.session_course_id = sc.id
            WHERE p.id = ? 
            AND cl.id = ? 
            AND LOWER(sc.status) = 'mounted' 
            AND sc.is_deleted = 'No'
            ORDER BY c.course ASC";

            $courses = DB::select($sql, [$sessionId, $classId]);

            return response()->json(['status' => 'success', 'courses' => $courses]);
        }
    }


    //TODO: GET all the session semester courses and lecturers to appraise them
    public function getLecturerAndCouses(Request $request)
    {
        if ($request->ajax()) {
            $sessionId = $request->session()->get('programme');
            $classId = $request->session()->get('level');

            $sql = "SELECT sc.id, c.course, c.course_code, lc.session_course_id, lc.lecturer_id, l.email,
            CONCAT(l.title, ' ', l.first_name, ' ', l.middle_name, ' ', l.last_name) AS lecturer
            FROM lecturer_courses lc
            INNER JOIN lecturers l on lc.lecturer_id = l.id
            INNER JOIN session_courses sc ON lc.session_course_id = sc.id
            INNER JOIN programmes p ON sc.programme_id = p.id
            INNER JOIN courses c ON sc.course_id = c.id
            INNER JOIN classes cl ON sc.classes_id = cl.id
            WHERE p.id = ? AND cl.id = ? AND sc.id = ? AND LOWER(sc.status) = 'mounted' AND sc.is_deleted = 'No'
            ORDER BY c.course ASC;";

            $courses = DB::select($sql, [$sessionId, $classId, $request->input('course_id')]);
            return response()->json(['status' => 'success', 'courses' => $courses]);
        }
    }

}
