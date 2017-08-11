<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;
use App\Models\SiteField;
use App\Models\SiteProfile;
use Flash;

class SiteController extends Controller
{
    public function index()
    {	
    	$sites = Site::orderBy('site_id','desc')->paginate(15);
    	return view('backend.site.index',compact('sites'));
    }

    public function getSiteImform($id=0)
    {
        $site = ($id>0)?Site::find($id):null;
        $step = ($site!=null)?$site->step:0;

        return view('backend.site.step_one',compact('site','step','id'));
    }

    public function getSiteField($id=0)
    {   
        if ($id==0) {
            return redirect('dashboard/sites/step_one/0');
        }
        $site_field = SiteField::where('site_id',$id)->first();
        $step = Site::where('site_id',$id)->value('step');

        return view('backend.site.step_two',compact('site_field','step','id'));
    }

    public function getSitePhoto($id=0)
    {   
        if ($id==0) {
            return redirect('dashboard/sites/step_one/0');
        }
        $site_photo = ($id>0)?SiteProfile::where('site_id',$id)->first():null;
        $step = Site::where('site_id',$id)->value('step');

        return view('backend.site.step_three',compact('site_photo','step','id'));
    }

    public function showPreview($id)
    {   
        if ($id==0) {
            return redirect('dashboard/sites/step_one/0');
        }
        $step = 4;
        $site = Site::find($id);
        return view('backend.site.step_four',compact('id','step','site'));
    }

    public function postSiteImform(Request $request,$id=0)
    {	
    	$location = ['lag'=>$request->lag,'lat'=>$request->lat];

    	$site = ($id>0)?Site::find($id):new Site;
    	$site->site_name = $request->site_name;
        $site->site_location = json_encode($location,true);
    	$site->data_limit = $request->limit_data;
    	$site->time_limit = $request->limit_time;    	
    	$site->status = ($site->status==null)?INACTIVE:$site->step;
        $site->step = ($site->step==null)?1:$site->step;
    	$site->save();

    	Flash::success('Successfully Site Add');
    	return redirect('dashboard/sites/step_two/'.$site->site_id);
    }

    public function postSiteField(Request $request,$id=0)
    {   
        
        $social_field = [ 
                    'fb'=>$request->fb,
                    'google'=>$request->google,
                    'gmail'=>$request->gmail
                    ];
        $form_field = [
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'age'=>$request->age,
                    'phone'=>$request->phone,
                    'field_1'=>$request->field_1,
                    'field_2'=>$request->field_2
                    ];
        $site_field = SiteField::where('site_id',$id)->first();
        $step = ($site_field!=null)?$request->step:2;
        $site_field = ($site_field!=null)?$site_field:new SiteField;
        $site_field->site_id = $id;
        $site_field->social_login = json_encode($social_field,true);
        $site_field->form_login = json_encode($form_field,true);
        $site_field->save();
        Site::find($id)->update(['step'=>$step]);

        Flash::success('Successfully Site Add');
        return redirect('dashboard/sites/step_three/'.$id);
    }

    public function postSitePhoto(Request $request,$id=0)
    {   
        if ($request->hasFile('file_1')) {
           $result_1 = fileUpload($request->file_1,'header');
        }
        if ($request->hasFile('file_2')) {
           $result_2 = fileUpload($request->file_2,'footer');
        }
        if ($request->hasFile('file_3')) {
           $result_3 = fileUpload($request->file_3,'background');
        }
        $site_profile = SiteProfile::where('site_id',$id)->first();
        $step = ($site_profile!=null)?$request->step:3;
        $site_profile = ($site_profile!=null)?$site_profile:new SiteProfile;
        $site_profile->site_id = $id;
        $site_profile->header_image = isset($result_1)?$result_1['file_path'].$result_1['file_name']:$site_profile->header_image;
        $site_profile->footer_image = isset($result_2)?$result_2['file_path'].$result_2['file_name']:$site_profile->footer_image;
        $site_profile->background_image = isset($result_3)?$result_3['file_path'].$result_3['file_name']:$site_profile->background_image;
        $site_profile->background_color = $request->color;
        $site_profile->save();
        Site::find($id)->update(['step'=>$step]);

        Flash::success('Successfully Site Add');
        return redirect('dashboard/sites/step_four/'.$id);
    }

    public function remove($id)
    {
    	Site::destroy($id);
    	Flash::success('Successfully Site Removing');

    	return back();
    }

    public function status($id)
    {
        Site::destroy($id);
        Flash::success('Successfully Site Removing');

        return back();
    }
}
