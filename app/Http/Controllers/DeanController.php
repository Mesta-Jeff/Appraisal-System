<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeanController extends Controller
{
    //
    public function dashboard()
    {
        return view("fa.dashboard");
    }
}
