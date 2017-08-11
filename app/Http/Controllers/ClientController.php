<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Site;
use Flash;

class ClientController extends Controller
{
    public function index()
    {	
    	$clients = Client::orderBy('client_id','desc')->paginate(15);

    	return view('backend.client.index',compact('clients'));
    }

    public function create()
    {	
    	$sites = Site::pluck('site_name','site_id');
    	return view('backend.client.create',compact('sites'));
    }

    public function edit($id)
    {	
    	$client = Client::find($id);
    	$sites = Site::pluck('site_name','site_id');
    	return view('backend.client.create',compact('client','sites'));
    }

    public function store(Request $request,$id=0)
    {	
    	$client = ($id>0)?Client::find($id):new Client;
    	$client->name = $request->name;
    	$client->site_id = $request->site_id;
    	$client->email = $request->email;
    	$client->password = bcrypt($request->password);
    	$client->status = ACTIVE;
    	$client->save();

    	Flash::success('Successfully Client Add');
    	return redirect('dashboard/clients');
    }

    public function remove($id)
    {
    	Client::destroy($id);
    	Flash::success('Successfully Client Removing');

    	return back();
    }
}
