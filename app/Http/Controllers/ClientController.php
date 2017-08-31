<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Site;
use App\User;
use Flash,Validator;

class ClientController extends Controller
{
    public function index()
    {	
    	$clients = Client::orderBy('client_id','desc')->paginate(15);
        
    	return view('backend.client.index',compact('clients'));
    }

    public function searchData(Request $request)
    {   
        $clients=[];
        $user = User::Search($request->all())->get();
        foreach ($user as $value) {
            $clients[] = $value->Client;
        }
        
        return view('backend.client.index',compact('clients'));
    }

    public function create()
    {	
    	$sites = Site::active()->pluck('site_name','site_id');
    	return view('backend.client.create',compact('sites'));
    }

    public function edit($id)
    {	
    	$client = Client::find($id);
    	$sites = Site::pluck('site_name','site_id');
    	return view('backend.client.create',compact('client','sites'));
    }

    public function store(Request $request)
    {	
        
        $rule = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6',
        'site_id' =>'required'
        ];
        $valid =  Validator::make($request->all(), $rule);
        if ($valid->fails()) {
            return back()->withErrors($valid);
        }

        $user =  User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'role'=>2,
            'status'=>INACTIVE,
            'password' => bcrypt($request['password']),
        ]);

    	$client = Client::where('user_id',$user->id)->first()==null?new Client:$client;
        $client->site_id = json_encode($request->site_id);
        $client->user_id = $user->id;
        $client->status = ACTIVE;
        $client->save();
       
    	Flash::success('Successfully Client Add');
    	return redirect('dashboard/clients');
    }

    public function update(Request $request,$id)
    {   
        $rule = [
            'name' => 'required|string|max:255',
            'email' => 'required|string',
            'site_id' =>'required'
        ];
        $valid =  Validator::make($request->all(), $rule);
        if ($valid->fails()) {
            return back()->withErrors($valid);
        }
        $client = Client::find($id);
        $client->site_id = json_encode($request->site_id);
        $client->status = ACTIVE;
        $client->save();

        $user = User::find($client->user_id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->get('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        Flash::success('Successfully Client update');
        return redirect('dashboard/clients');
    }

    public function remove($id)
    {
    	$client = Client::find($id);
        User::destroy($client->user_id);
        $client->delete();

    	Flash::success('Successfully Client Removing');

    	return back();
    }
}
