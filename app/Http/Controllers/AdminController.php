<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Flash;

class AdminController extends Controller
{
    public function index()
    {	
    	$users = User::all();
    	return view('backend.admin.index',compact('users'));
    }

    public function update(Request $request,$id)
    {
    	User::find($id)->update(['name'=>$request->name,'email'=>$request->email]);
    	Flash::success('successfully admin user edited.');
    	return back();
    }

    public function remove($id)
    {
    	User::destroy($id);
    	Flash::success('successfully admin user remove.');
    	return back();
    }
}
