<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Flash,Validator;

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

    public function updateSelf(Request $request,$id)
    {
        $rule = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6|confirmed',
        ];
        if (!$request->password) {
            unset($rule['password']);
        }
        $valid = Validator::make($request->all(),$rule);
        if ($valid->fails()) {
            Flash::error('Some input has error');
            return back()->withErrors($valid);
        }

        $user = User::find($id);
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=($request->password)?bcrypt($request->password):$user->password;
        $user->save();
        Flash::success('successfully admin user edited.');
        return back();
    }
}
