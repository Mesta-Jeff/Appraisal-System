<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    //

    public function login(Request $request)
    {
        return view("auth.login");
    }
    public function recover_password(Request $request)
    {
        return view("auth.recover-password");
    }
    public function reset_password(Request $request)
    {
        return view("auth.reset-password");
    }
}
