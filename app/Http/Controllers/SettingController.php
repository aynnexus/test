<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Lookup;
use Flash,Auth;

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

    public function indexLookup()
    {
        $lookups = Lookup::orderBy('lookup_id','desc')->paginate(10);
        return view('backend.lookup.index',compact('lookups'));
    }

    public function storeLookup(Request $request,$id=0)
    {   
        $lookup = ($id>0)?Lookup::find($id):new Lookup;
        $lookup->title = ($id>0)?$lookup->title:$request->title;
        $lookup->key = $request->key;
        $lookup->value = $request->value;
        $lookup->status = ACTIVE;
        $lookup->created_by = Auth::id();
        $lookup->save();

        Flash::success('Successfully Lookup Add');
        return redirect('dashboard/settings/lookup');
    }

    public function removeLookup($id)
    {
        Lookup::destroy($id);
        Flash::success('Successfully Lookup Removing');

        return back();
    }

    public function changeStatusLookup($status,$id)
    {
        Lookup::where('lookup_id',$id)->update(['status'=>$status]);
        Flash::success('Successfully Status changing');

        return back();
    }
}
