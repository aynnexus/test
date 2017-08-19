<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;
use App\Models\Template;
use App\Models\Lookup;

class GuestController extends Controller
{
    public function index($id)
    {	
    	$site=null;$temp=[];
    	//$site = Site::where('site_id',$id)->active()->first();
    	$look_age = Lookup::where('title','Age Group')->pluck('value','key');
    	$temps = Template::active()->get();
    	if (!$temps->isEmpty()) {
            foreach ($temps as $key => $value) {
                $sit = $value->AllSite($value->site_id);
                foreach ($sit as $tem) {
                    if ($tem->site_id==$id) {
                        $site = $tem;
                        $temp = $value;
                    }
                }
            }
        }
        if ($temp==null) {
            return abort(403, 'Unauthorized action.');
        }
        
    	return view('frontend.index',compact('site','temp','look_age'));
    }

   
}
