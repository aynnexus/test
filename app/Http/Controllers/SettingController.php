<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Flash;

class SettingController extends Controller
{
    public function indexImg()
    {	
    	$images = Image::all();

    	return view('backend.setting.image',compact('images'));
    }

    public function storeImg(Request $request,$id=0)
    {	
    	$image = ($id>0)?Image::find($id):new Image;
    	$image->width = $request->width;
    	$image->height = $request->height;
    	$image->position = $request->position;
    	$image->status = ACTIVE;
    	$image->save();

    	Flash::success('Successfully Image Add');
    	return redirect('dashboard/settings/images');
    }

    public function removeImg($id)
    {
    	Image::destroy($id);
    	Flash::success('Successfully Image Removing');

    	return back();
    }
}
