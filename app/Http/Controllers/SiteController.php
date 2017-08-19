<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;
use App\Models\SiteField;
use App\Models\SiteProfile;
use App\Models\Template;
use App\Models\Rate;
use App\Models\Rating;
use Flash,Auth;

class SiteController extends Controller
{
    public function index()
    {	
    	$sites = Site::orderBy('site_id','desc')->paginate(15);
    	return view('backend.site.index',compact('sites'));
    }

    public function indexTemplate()
    {   
        $templates = Template::orderBy('site_id','desc')->paginate(15);
        return view('backend.template.index',compact('templates'));
    }

    public function getSiteImform($id=0)
    {
        $template = ($id>0)?Template::find($id):null;
        $step = ($template!=null)?$template->step:0;
        $tem = Template::all();
        $site_id=$final=[];
        $sites = Site::active()->pluck('site_name','site_id');
        
        return view('backend.template.step_one',compact('template','step','id','sites'));
    }

    public function getSiteField($id=0)
    {   
        if ($id==0) {
            return redirect('dashboard/template/step_one/0');
        }
        $site_field = SiteField::where('template_id',$id)->first();
        $step = Template::where('template_id',$id)->value('step');
        
        return view('backend.template.step_two',compact('site_field','step','id'));
    }   

    public function getSitePhoto($id=0)
    {   
        if ($id==0) {
            return redirect('dashboard/template/step_one/0');
        }
        $site_photo = ($id>0)?SiteProfile::where('template_id',$id)->first():null;
        $step = Template::where('template_id',$id)->value('step');

        return view('backend.template.step_three',compact('site_photo','step','id'));
    }

    public function getFeedback($id)
    {   
        if ($id==0) {
            return redirect('dashboard/template/step_one/0');
        }
        $ratings=[];
        $feedback = SiteField::where('template_id',$id)->first();
        $step = Template::where('template_id',$id)->value('step');
        $rate = Rate::pluck('label','rate_id');
        $rating = Rating::where('template_id',$id)->get();
        if (!$rating->isEmpty()) {
            foreach ($rating->toArray() as $key => $value) {
               $ratings[] = $value['rate_id'];
            }
        }

        return view('backend.template.step_four',compact('id','step','feedback','rate','ratings'));
    }

    public function getAds($id)
    {
        if ($id==0) {
            return redirect('dashboard/template/step_one/0');
        }
        
        $step = Template::where('template_id',$id)->value('step');

        return view('backend.template.step_five',compact('id','step'));
    }

    public function showPreview($id)
    {   
        if ($id==0) {
            return redirect('dashboard/template/step_one/0');
        }
        $step = 4;
        $template = Template::find($id);
        return view('backend.template.preview',compact('id','step','template'));
    }

    public function storeSite(Request $request, $id)
    {
        $location = ['lag'=>$request->lag,'lat'=>$request->lat];

        $site = ($id>0)?Site::find($id):new Site;
        $site->site_name = $request->site_name;
        $site->site_location = json_encode($location,true);
        $site->data_limit = $request->limit_data;
        $site->time_limit = $request->limit_time;   
        $site->timeout_limit = $request->timeout_limit;    
        $site->speed_limit = $request->speed_limit;        
        $site->status = ($site->status==null)?INACTIVE:$site->status;        
        $site->save();

        Flash::success('Successfully Site Add');
        return back();
    }

    public function postSiteImform(Request $request,$id=0)
    {	
        $template = ($id>0)?Template::find($id):new Template;
    	$template->site_id = json_encode($request->site_name,true);   	
    	$template->status = ($template->status==null)?INACTIVE:$template->step;
        $template->step = ($template->step==null)?1:$template->step;
        $template->created_by = Auth::id();
    	$template->save();

    	Flash::success('Successfully Site Add');
    	return redirect('dashboard/template/step_two/'.$template->template_id);
    }

    public function postSiteField(Request $request,$id=0)
    {   
        $social_field = [ 
                    'fb'=>$request->fb,
                    //'fb_req'=>$request->fb_require,
                    'gmail'=>$request->gmail,
                    //'g_req'=>$request->gmail_require
                    ];
        $form_field = [
                    'name'=>$request->name,
                    'n_req'=>$request->name_require,
                    'email'=>$request->email,
                    'e_req'=>$request->email_require,
                    'age'=>$request->age,
                    'a_req'=>$request->age_require,
                    'phone'=>$request->phone,
                    'p_req'=>$request->phone_requird,
                    'field_1'=>$request->field_1,
                    'f1_req'=>$request->cs1_require,
                    'field_2'=>$request->field_2,
                    'f2_req'=>$request->cs2_require
                    ];
        $site_field = SiteField::where('template_id',$id)->first();
        $step = ($site_field!=null)?$request->step:2;
        $site_field = ($site_field!=null)?$site_field:new SiteField;
        $site_field->template_id = $id;
        $site_field->social_login = json_encode($social_field,true);
        $site_field->form_login = json_encode($form_field,true);
        $site_field->save();
        Template::find($id)->update(['step'=>$step]);

        Flash::success('Successfully Site Add');
        return redirect('dashboard/template/step_three/'.$id);
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
        if ($request->hasFile('file_4')) {
           $result_4 = fileUpload($request->file_4,'logo');
        }
        $site_profile = SiteProfile::where('template_id',$id)->first();
        $step = ($site_profile!=null)?$request->step:3;
        $site_profile = ($site_profile!=null)?$site_profile:new SiteProfile;
        $site_profile->template_id = $id;
        $site_profile->header_image = isset($result_1)?$result_1['file_path'].$result_1['file_name']:$site_profile->header_image;
        $site_profile->footer_image = isset($result_2)?$result_2['file_path'].$result_2['file_name']:$site_profile->footer_image;
        $site_profile->background_image = isset($result_3)?$result_3['file_path'].$result_3['file_name']:$site_profile->background_image;
        $site_profile->logo_image = isset($result_4)?$result_4['file_path'].$result_4['file_name']:$site_profile->logo_image;
        $site_profile->background_color = $request->color;
        $site_profile->save();
        Template::find($id)->update(['step'=>$step]);

        Flash::success('Successfully Site Add');
        return redirect('dashboard/template/step_four/'.$id);
    }

    public function postFeedback(Request $request,$id)
    {
        $feedback_field = [
                    'checkin'=>$request->checkin,
                    'like'=>$request->like,
                    'comment'=>$request->comment,
                    'cbb_require'=>$request->cbb_require,
                    'survey'=>$request->survey,
                    's_require'=>$request->s_require,
                    'r_require'=>$request->r_require,
                    'rate'=>$request->rate                    
                    ];
        if ($request->has('rate_id')) {
            Rating::where('template_id',$id)->delete();
            for ($i=0; $i < count($request->rate_id); $i++) {                 
                $rate = new Rating;
                $rate->template_id = $id;
                $rate->rate_id = $request->rate_id[$i];
                $rate->save();
            }

        }
        $feedback = SiteField::UpdateOrCreate(['template_id'=>$id],[
                'feedback_fields'=>json_encode($feedback_field,true)
            ]);

        Template::find($id)->update(['step'=>4]);

        Flash::success('Successfully Feedback Add');
        return redirect('dashboard/template/step_five/'.$id);
    }

    public function remove($id)
    {
    	Site::destroy($id);
    	Flash::success('Successfully Site Removing');

    	return back();
    }

    public function removeTemplate($id)
    {   
        Template::destroy($id);
        Flash::success('Successfully Template Removing');

        return back();
    }

    public function changeStatusSite($status,$id)
    {
        Site::where('site_id',$id)->update(['status'=>$status]);
        Flash::success('Successfully Status changing');

        return back();
    }

    public function changeStatusTemplate($status,$id)
    {
        Template::where('template_id',$id)->update(['status'=>$status]);
        Flash::success('Successfully Status changing');

        return back();
    }

    public function addRate(Request $request,$id=0)
    {
        $rate = Rate::UpdateOrCreate(['rate_id'=>$id],[
            'label'=>$request->rate_title,
            'created_by'=>Auth::id(),
            'status'=>ACTIVE
            ]);
        return back();
    }
}
