<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Auth,Flash;

class MemberController extends Controller
{
    public function getlogin()
    {
    	return view('auth.member_login');
    }

    public function postlogin(Request $request)
    {
    	$rules = [
            'email'     => $request->email,
            'password'  => $request->password,
        ];

        if(Auth::attempt($rules))         
            return redirect('dashboard');
        else   
        	Flash::error('Invalid user name and password!');
           return back();
    }
}
