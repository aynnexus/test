<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;
use App\Models\Template;
use App\Models\Guest;
use App\Models\Client;
use App\Models\Lookup;
use App\Models\Answer;
use App\Models\Survey;
use Unifi,Session,Flash,DateTime,Socialite,Auth;

class GuestController extends Controller
{
    public function index(Request $request,$id)
    {	
        $date_time = new DateTime();
        $curr_datetime_format = $date_time->format('Y-m-d H:i:s');
        $user_ap = $request->ap;
        if (isset($request->id)) {
            $url = explode('/', $_SERVER['REDIRECT_URL']);
            Session::put('ap',$request->id);
            Session::put('site',$url[3]);
            $guest = Guest::where('user_ap',$request->ap)->value('created_at');
            $site_info = Site::where('site_code',$url[3])->first();
            $define_minute = $site_info->time_limit+$site_info->timeout_limit;
            
            if ($guest!=null) {
                $guest_created_format = $guest->format('Y-m-d H:i:s');
                $format_1 = datetime_convert($curr_datetime_format,$site_info->time_limit);
                $format_2 = datetime_convert($guest_created_format,$define_minute);
                if ($format_1 <= $format_2) {
                    return redirect('404');
                }                
            }                 
        }

        $site=null;$temp=[];
    	//$site = Site::where('site_id',$id)->active()->first();
        $look_age = Lookup::where('title','Age Group')->pluck('value','key');
        $look_gender = Lookup::where('title','GENDER')->pluck('value','key');
        $temps = Template::active()->get();
        if (!$temps->isEmpty()) {
            foreach ($temps as $key => $value) {
                $sit = $value->AllSite($value->site_id);
                foreach ($sit as $tem) {
                    if ($tem->site_code==$id) {
                        $site = $tem;
                        $temp = $value;
                    }
                }
            }
        }
        if ($temp==null) {
            return abort(403, 'Unauthorized action.');
        }
        Session::put('template',$temp->template_id);

        return view('frontend.index',compact('site','temp','look_age','look_gender','user_ap'));
    }

    public function indexLists(Request $request,$type='register')
    {   
        $type = ($type=='register')?1:2;
        if(Auth::user()->role==1)
        {   
            $sites = Site::active()->pluck('site_id','site_name');
            
            if ($request->get('site_id')) {
                $guests = Guest::search($request->all())->orderBy('guest_id','desc')->paginate(20);

            }else{
                $guests = Guest::where('type',$type)->orderBy('guest_id','desc')->paginate(20);
            }

            return view('backend.guest.index',compact('guests','sites'));
        }
        return back();
    }

    public function removeGuest($id)
    {
        Guest::destroy($id);
        Flash::success('Successfully Guest user deleting');
        return back();
    }

    public function loginUser(Request $request)
    {   
        $ap = Session::get('ap');
        $site = Session::get('site');

        $guest = new Guest;
        $guest->name = $request->name;
        $guest->email = $request->email;
        $guest->age = $request->age;
        $guest->phone = $request->phone;
        $guest->gender = $request->gender;
        $guest->custom_1 = $request->custom_1;
        $guest->custom_2 = $request->custom_2;
        $guest->site_id = Site::where('site_code',$site)->value('site_id');
        $guest->user_ap = $request->user_ap;
        $guest->type = REGISTER;
        $guest->status = INACTIVE;
        $guest->save();
        $site_data = Site::where('site_code',$site)->first();
        
        if($this->authorizeGuest($site,$site_data->timeout_limit,$ap,$site_data->speed_limit,$site_data->speed_limit,$site_data->data_limit)==true){

            return redirect('guest/feedback/'.$guest->guest_id);
        }        
        return back();
    }

    public function getFeedback($id=0)
    {   
        if ($id==0) {
            return back();
        }
        $temp_id = Session::get('template');
        $temp = Template::find($temp_id);
        
        return view('frontend.feedback',compact('temp','id'));
    }

    public function detail($id)
    {
        $guest = Guest::find($id);
        return view('backend.guest.detail',compact('guest'));
    }

    public function postFeedback(Request $request,$id)
    {   //dd($request->all());
        $ap = Session::get('ap');
        $site = Session::get('site');
        $temp_id = Session::get('template');
        $temp = Template::find($temp_id);
        $site_data = Site::where('site_code',$site)->first();
        foreach ($temp->Rating as $key => $value) {
            $values[] = $request[$value->Rate->label.'_'];
            $keys[] = $value->Rate->label;
        }
        
        Guest::find($id)->update(['comment'=>$request->comment,'rating_key'=>json_encode($keys),'rating_value'=>json_encode($values)]);
        for ($i=0; $i < count($temp->Surveying); $i++) { 
            $ans = Answer::find($request['answer'.$i]);
            $survey = new Survey;
            $survey->guest_id = $id;
            $survey->answer = $ans->label;
            $survey->question = $temp->Surveying[$i]->Question->label;
            $survey->status = ACTIVE;
            $survey->save();
        }
        
        //if($this->authorizeGuest($site,$site_data->timeout_limit,$ap,$site_data->speed_limit,$site_data->speed_limit,$site_data->data_limit)==true){
            header('Location: http://www.google.com');exit();
        //}

        //return back();
    }

    public static function authorizeGuest($id,$minutes,$ap_mac,$up=NULL,$down=NULL,$mb=NULL)
    {   
        $api = new Unifi;
        $api->user = unifiUser;
        $api->password = unifiPass;
        $api->baseurl = unifiServer;        
        $api->site = $id;
        if ($api->login($ap_mac,$minutes,$up,$down,$mb)==true) {
            return true;
        }        
        return false;
    }

    public function getSiteInGuest(Request $request,$id)
    {           
        if ($request->get('site_name')) {
            $guests = Guest::search($request->all())->paginate(10);
            $sites = Site::active()->pluck('site_id','site_name');
            return view('backend.guest.index',compact('guests','sites'));
        }
        $client = Client::find($id)->value('site_id');
        $sites = Site::whereIn('site_id',json_decode($client))->get();

        return view('backend.guest.site_guests',compact('sites'));
    }

    public function searchSiteName(Request $request,$id)
    {   
        if ($request->get('name')) {
            $site = Site::search($request->all())->first();
            return view('backend.guest.index',compact('site'));
        }
    }

    public function searchData(Request $request)
    {   
        if ($request->get('site_name')) {
            $site = Site::search($request->all())->first();
        }
        return view('backend.guest.site_guests',compact('site'));
    }

    public function redirectToProvider($provider)
    {   
        $ap = Session::get('ap');
        $site = Session::get('site');
        if($this->authorizeGuest($site,FIRST_AUTH,$ap)==true){
            return Socialite::driver($provider)->redirect();
        }
        
    }

    public function handleProviderCallback($provider)
    {    
        try {
            $social_user = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            return redirect('/');
        }
        dd($social_user);
        $guest = new Guest;
        $guest->name = $social_user->getName();
        $guest->social_id = $social_user->getId();
        $guest->email = $social_user->getEmail();
        $guest->profile_photo = $social_user->getAvatar();
        $guest->gender = ($social_user->getGender()=='male')?1:2;
        $guest->status = ACTIVE;
        $guest->type = SOCIAL;
        $guest->save();

        return redirect('guest/feedback/'.$guest->guest_id);
        // $user = User::where('social_id',$social_user->getId())->first();
        // $user = (!$user)?new User:$user;
        // $user->social_id = $social_user->getId();
        // $user->name = $social_user->getName();
        // $user->email = $social_user->getEmail();
        // $user->role_id = 3;
        // $user->status=ACTIVE;
        // $user->save();
        // $detail = UserDetail::where('user_id',$user->id)->first();
        // $detail = (!$detail)?new UserDetail:$detail;
        // $detail->user_id = $user->id;
        // $detail->photo_path = $social_user->getAvatar();
        // $detail->status = ACTIVE;
        // $detail->save();
    }

}
