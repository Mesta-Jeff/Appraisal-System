<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppraisalController extends Controller
{
    //

    public function availableStaff(Request $request)
    {
        return view('appraise.available-staff');
    }

    public function rejectedAppraisal(Request $request)
    {
        return view('appraise.rejected-appraisal');
    }

    public function studentsBeenAppraised(Request $request)
    {
        return view('appraise.students-been-appraised');
    }

    public function staffBeenAppraised(Request $request)
    {
        return view('appraise.staff-been-appraised');
    }

    public function appraisalStatistics(Request $request)
    {
        return view('appraise.appraisal-statistics');
    }

    public function lecturerBasedStatistics(Request $request)
    {
        return view('appraise.lecturer-based-statistics');
    }

    public function departmentBasedStatistics(Request $request)
    {
        return view('appraise.department-based-statistics');
    }

    public function facultyBasedStatistics(Request $request)
    {
        return view('appraise.faculty-based-statistics');
    }

    public function listOfAppraisedStaff(Request $request)
    {
        return view('appraise.list-of-appraised-staff');
    }

    public function listOfAppraisedStudents(Request $request)
    {
        return view('appraise.list-of-appraised-students');
    }
}
