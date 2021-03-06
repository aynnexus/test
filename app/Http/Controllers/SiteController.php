<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;
use App\Models\SiteField;
use App\Models\SiteProfile;
use App\Models\Template;
use App\Models\Rate;
use App\Models\Rating;
use App\Models\Question;
use App\Models\Survey;
use App\Models\Surveying;
use App\Models\Client;
use App\Models\Ads;
use App\Models\Lookup;
use App\Models\Service;
use App\Models\TemplateMovement;
use Flash,Auth,Validator;

class SiteController extends Controller
{   
   
    public function __construct()
    {   
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            if ($this->user->role!=1) {
                $this->site_id = json_decode(Client::where('user_id',$this->user->id)->value('site_id'));   
            }
            return $next($request);
        });
        
    }

    public function index(Request $request)
    {	
        $sites = Site::orderBy('site_id','desc')->paginate(15);
        if ($request->get('name')) {
            $sites = Site::Search($request->all())->orderBy('site_id','desc')->paginate(15);
        }
    	return view('backend.site.index',compact('sites'));
    }

    public function indexTemplate(Request $request)
    {   

        if(Auth::user()->role==1)
        {   
            $templates = Template::orderBy('site_id','desc')->paginate(15);
            if ($request->get('name')) {
                $templates = Template::Search($request->all())->orderBy('site_id','desc')->paginate(15);
            }
            
        }else{
            $move = TemplateMovement::whereIn('site_id',$this->site_id)->get();
            foreach ($move as $key => $value) {
                $template_id[] = $value->template_id;                
            }
            $templates = Template::whereIn('template_id',$template_id)->orderBy('site_id','desc')->paginate(15);
            if ($request->get('name')) {
                $templates = Template::Search($request->all())->whereIn('site_id',$this->site_id)->orderBy('site_id','desc')->paginate(15);
            }
        }

        return view('backend.template.index',compact('templates'));
    }

    public function getSiteImform($id=0)
    {   
        if (Auth::user()->role!=1) {
            $move = TemplateMovement::whereIn('site_id',$this->site_id)->where('template_id',$id)->get();        
            // if ($move->isEmpty()) {
            //     return back();
            // }
            $sites = Site::whereIn('site_id',$this->site_id)->pluck('site_name','site_id');
        }else{

            $sites = Site::active()->pluck('site_name','site_id');
        }
        $template = ($id>0)?Template::find($id):null;
        $step = ($template!=null)?$template->step:0;
        $tem = Template::all();
        $site_id=$final=[];
        
        return view('backend.template.step_one',compact('template','step','id','sites'));
    }

    public function getSiteField($id=0)
    {   
        if (Auth::user()->role!=1) {
            $move = TemplateMovement::whereIn('site_id',$this->site_id)->where('template_id',$id)->get();
            if ($id==0 || $move->isEmpty()) {
                return back();
            }
        }

        $site_field = SiteField::where('template_id',$id)->first();
        $step = Template::where('template_id',$id)->value('step');
        $facebook = Service::where('type',1)->pluck('id','service_id');
        $google = Service::where('type',2)->pluck('id','service_id');
        
        return view('backend.template.step_two',compact('site_field','step','id','google','facebook'));
    }   

    public function getSitePhoto($id=0)
    {   
        if (Auth::user()->role!=1) {
            $move = TemplateMovement::whereIn('site_id',$this->site_id)->where('template_id',$id)->get();
            if ($id==0 || $move->isEmpty()) {
                return back();
            }
        }

        $site_photo = ($id>0)?SiteProfile::where('template_id',$id)->first():null;
        $step = Template::where('template_id',$id)->value('step');

        return view('backend.template.step_three',compact('site_photo','step','id'));
    }

    public function getFeedback($id)
    {   
        if (Auth::user()->role!=1) {
            $move = TemplateMovement::whereIn('site_id',$this->site_id)->where('template_id',$id)->get();
            if ($id==0 || $move->isEmpty()) {
                return back();
            }
        }

        $ratings=$surveyings=[];
        $feedback = SiteField::where('template_id',$id)->first();
        $step = Template::where('template_id',$id)->value('step');
        $rate = Rate::pluck('label','rate_id');
        $survey = Question::pluck('slug','question_id');
        $rating = Rating::where('template_id',$id)->get();
        $surveying = Surveying::where('template_id',$id)->get();
        if (!$rating->isEmpty()) {
            foreach ($rating->toArray() as $key => $value) {
               $ratings[] = $value['rate_id'];
            }
        }
        if (!$surveying->isEmpty()) {
            foreach ($surveying->toArray() as $key => $value) {

               $surveyings[] = $value['survey_id']; 
            }
        }
           
        return view('backend.template.step_four',compact('id','step','feedback','rate','ratings','survey','surveyings'));
    }

    public function getAds($id)
    {   
        if (Auth::user()->role!=1) {
            $move = TemplateMovement::whereIn('site_id',$this->site_id)->where('template_id',$id)->get();
            if ($id==0 || $move->isEmpty()) {
                return back();
            }
        }
        $ads = Ads::where('template_id',$id)->get();
        $gender = Lookup::where('title','GENDER')->pluck('value','key');
        $age = Lookup::where('title','Age Group')->pluck('value','key');

        $step = Template::where('template_id',$id)->value('step');

        return view('backend.template.step_five',compact('id','step','ads','age','gender'));
    }

    public function showPreview($id)
    {   
        if (Auth::user()->role!=1) {
            $move = TemplateMovement::whereIn('site_id',$this->site_id)->where('template_id',$id)->get();
            if ($id==0 || $move->isEmpty()) {
                return back();
            }
        }
        $step = 4;
        $template = Template::find($id);
        return view('backend.template.preview',compact('id','step','template'));
    }

    public function storeSite(Request $request, $id)
    {   
        $site = ($id>0)?Site::find($id):new Site;
        $site->site_name = $request->site_name;
        $site->site_code = $request->site_code;
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
    	if($template->save()){
            TemplateMovement::where('template_id',$template->template_id)->where('auth_id',Auth::id())->delete();
            for ($i=0; $i < count($request->site_name); $i++) { 
                $move = new TemplateMovement;
                $move->template_id = $template->template_id;
                $move->site_id = $request->site_name[$i];
                $move->auth_id = Auth::id();
                $move->save();
            }
        }

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
                        'gender'=>$request->gender,
                        'g_req' => $request->gender_require,
                        'a_req'=>$request->age_require,
                        'phone'=>$request->phone,
                        'p_req'=>$request->phone_requird,
                        'field_1'=>$request->field_1,
                        'f1_req'=>$request->cs1_require,
                        'field_2'=>$request->field_2,
                        'f2_req'=>$request->cs2_require,
                        'field_1_value'=>$request->field_1_value,
                        'field_2_value'=>$request->field_2_value
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

        Flash::success('Successfully template saving.');
        return redirect('dashboard/template/step_four/'.$id);
    }

    public function postFeedback(Request $request,$id)
    {   
        $feedback_field = [
                    'checkin'=>$request->checkin,
                    'like'=>$request->like,
                    'like_page'=>$request->like_page,
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
        if ($request->has('survey_id')) {
            Surveying::where('template_id',$id)->delete();
            for ($i=0; $i < count($request->survey_id); $i++) {                 
                $rate = new Surveying;
                $rate->template_id = $id;
                $rate->survey_id = $request->survey_id[$i];
                $rate->save();
            }
        }
        $feedback = SiteField::UpdateOrCreate(['template_id'=>$id],[
                'feedback_fields'=>json_encode($feedback_field,true),
                'iframe_link' => $request->iframe,'url'=>$request->url
            ]);
        
        Template::find($id)->update(['step'=>4]);

        Flash::success('Successfully Feedback Add');
        return redirect('dashboard/template/step_five/'.$id);
    }

    public function postAds(Request $request,$id=0)
    {
        $rule = ['gender'=>'required','age'=>'required','timeout'=>'required'];
        $valid  = Validator::make($request->all(),$rule);
        if ($valid->fails()) {
            return back()->withErrors($valid);
        }
        if ($request->hasFile('photo')) {
            $result = fileUpload($request->photo,'ads');
        }
        $ads = ($id>0)?Ads::find($id):new Ads;
        $ads->target_age = implode(',', $request->age);
        $ads->target_gender = $request->gender;
        $ads->template_id = $request->template_id;
        $ads->type = $request->type;
        $ads->timeout = $request->timeout;
        $ads->video = $request->video;
        $ads->photo = isset($result)?$result['file_path'].$result['file_name']:$ads->photo;
        $ads->status = $request->status;
        $ads->user_id = Auth::id();
        $ads->save();
        Template::find($request->template_id)->update(['step'=>5]);

        Flash::success('Successfully ads creating');
        return redirect('dashboard/template/step_five/'.$request->template_id);
    }

    public function removeAds($id)
    {
        Ads::destroy($id);
        Flash::success('Successfully ads removing');
        return back();
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
            'label'=>strtolower($request->rate_title),
            'created_by'=>Auth::id(),
            'status'=>ACTIVE
            ]);
        return back();
    }

    public function addSurvey(Request $request,$id=0)
    {   
        $rate = Survey::UpdateOrCreate(['survey_id'=>$id],[
            'label'=>strtolower($request->survey_title),
            'slug'=>$request->slug,
            'created_by'=>Auth::id(),
            'status'=>ACTIVE
            ]);
        return back();
    }

    public function removePhoto(Request $request)
    {   
        $site = SiteProfile::where('template_id',$request->id)->first();
        switch ($request->type) {
            case 'hd':
                $site->update(['header_image'=>null]);
                break;
            case 'lg':
                $site->update(['logo_image'=>null]);
                break;
            case 'ft':
                $site->update(['footer_image'=>null]);
                break;
            case 'bg':
                $site->update(['background_image'=>null]);
                break;
            
            default:break;
        }
        Flash::success('Successfully photo removing');
        return back();
    }
}
