<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    public function seatNumber()
    {
        return view("student.seat-number");
    }
}
