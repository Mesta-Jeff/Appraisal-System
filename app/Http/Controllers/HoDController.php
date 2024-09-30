<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HoDController extends Controller
{
    //
    public function dashboard()
    {
        return view("dept.dashboard");
    }
}
