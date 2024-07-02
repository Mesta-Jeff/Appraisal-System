<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function usersAccount(Request $request)
    {
        // Your logic here
        return view('settings.users');
    }

    public function Students(Request $request)
    {
        // Your logic here
        return view('settings.students');
    }
    public function Staff(Request $request)
    {
        // Your logic here
        return view('settings.staffs');
    }
}