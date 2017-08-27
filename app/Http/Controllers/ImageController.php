<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class ImageController extends Controller
{
    public function index()
    {	
    	$images = Image::all();

    	return view('backend.image',compact('images'));
    }

    public function store(Request $request,$id=0)
    {	
    	$image = ($id>0)?Image::find($id):new Image;
    	$image->width = $request->width;
    	$image->height = $request->height;
    	$image->position = $request->position;
    	$image->status = ACTIVE;
    	$image->save();

    	Flash::success('Successfully Image Add');
    	return redirect('dashboard/images');
    }

    public function remove($id)
    {
    	Image::destroy($id);
    	Flash::success('Successfully Image Removing');

    	return back();
    }
}
