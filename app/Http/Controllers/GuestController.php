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
use App\Models\Movement;
use App\Models\Ads;
use Unifi,Session,Flash,DateTime,Socialite,Auth;

class GuestController extends Controller
{   
    public function __construct()
    {   
        $this->middleware(function ($request, $next) {
            $this->user = Auth::id();
            $this->site_id = json_decode(Client::where('user_id',$this->user)->value('site_id'));
            return $next($request);
        });
        
    }
    
    public function index(Request $request,$id)
    {	
        $date_time = new DateTime();
        $curr_datetime_format = $date_time->format('Y-m-d H:i:s');
        $user_ap = $request->id;
        if (isset($request->id)) {
            $url = explode('/', $_SERVER['REDIRECT_URL']);
          
            $guest = Guest::where('user_ap',$request->id)->get()->last();
            $site_info = Site::where('site_code',$url[3])->first();
            if ($site_info==null) {
                return back();
            }                
            $define_minute = $site_info->time_limit+$site_info->timeout_limit;
            Movement::MovementStore($site_info->site_id);
            
            if ($guest!=null) {
                $guest_created_format = $guest->created_at->format('Y-m-d H:i:s');
                $format_1 = datetime_convert($curr_datetime_format,$site_info->time_limit);
                $format_2 = datetime_convert($guest_created_format,$define_minute);
                //echo $format_1;
                //echo $format_2;
                //dd($format_2);
                if ($format_1 <= $format_2) {
                    $cli = Client::active()->get();  
                    foreach ($cli as $c) {
                        $sit = $c->Allsite($c->site_id);      
                        foreach ($sit as $s) { 
                            if ($s->site_id==$site_info->site_id) {
                                $cl =$c;
                            }
                        }
                    }    
                    $error = '';               
                    if (isset($cl)) {
                        $error = $cl->User->name;
                    }
                    return view('frontend.error.'.$error.'block');
                }                
            } 
            Session::put('ap',$request->id);
            Session::put('site',$url[3]);            
            Session::put('user_ap',$request->id);
            Session::put('os_type',$request->header('User-Agent'));                
        }

        $site=null;$temp=[];
    	//$site = Site::where('site_id',$id)->active()->first();
        
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
        $look_age = Lookup::where('title','Age Group')->pluck('value','key');
        $look_gender = Lookup::where('title','GENDER')->pluck('value','key');

        return view('frontend.index',compact('site','temp','look_age','look_gender','user_ap'));
    }

    public function indexLists(Request $request,$type='register')
    {   
        if ($type=='register') {
           $type =1;
        }elseif ($type=='social') {
            $type =2;
        }else{
            $type = 3;
        }
        $order = ($type==3)?'user_ap':'guest_id';
        if(Auth::user()->role==1)
        {   
            $sites = Site::active()->pluck('site_id','site_name');
            
            if ($request->get('site_id') || $request->get('name') || $request->get('from_date')) {
                $guests = Guest::search($request->all())->orderBy($order,'desc')->paginate(20);
                
            }else{
                if ($type==3) {
                    $guests = Guest::groupBy($order)->orderBy($order,'desc')->paginate(20);
                }else{
                    $guests = Guest::where('type',$type)->groupBy($order)->orderBy($order,'desc')->paginate(20);
                }
            }
            
        }else{
            $sites = Site::whereIn('site_id',$this->site_id)->pluck('site_id','site_name');
            
            if ($request->get('site_id')) {
                $guests = Guest::search($request->all())->whereIn('site_id',$this->site_id)->orderBy($order,'desc')->paginate(20);
            }else{
                if ($type==3) {
                    $guests = Guest::whereIn('site_id',$this->site_id)->groupBy($order)->orderBy($order,'desc')->paginate(20);  
                }else{
                    $guests = Guest::whereIn('site_id',$this->site_id)->where('type',$type)->groupBy($order)->orderBy($order,'desc')->paginate(20);  
                }
                              
            }
        }
       
        return view('backend.guest.index',compact('guests','sites'));
    }

    public function singleDetail($id)
    {
        $guest = Guest::find($id);
        $guests = Guest::where('user_ap',$guest->user_ap)->select('email','phone','created_at')->get();
        return response()->json($guests);
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
        $guestId = $this->firstCreated();

        $guest = Guest::find($guestId['id'])->update([
            'name'=>$request->name,'email'=>$request->email,
            'age'=>$request->age,'phone'=>$request->phone,
            'gender' => $request->gender,
            'custom_1' => $request->custom_1,
            'custom_2' => $request->custom_2,
            'type' => REGISTER,
            'os'=>$guestId['os']
        ]);
        $site_data = Site::where('site_code',$site)->first();
        
        if($this->authorizeGuest($site,$site_data->time_limit,$ap,$site_data->speed_limit,$site_data->speed_limit,$site_data->data_limit)==true){
            
            return redirect('guest/feedback/'.$guestId['id']);
        }        
        return back();
    }

    public function getFeedback($id=0)
    {   
        if ($id==0) {
            return back();
        }
        $temp_id = Session::get('template');
        //$temp_id = 2;
        $temp = Template::find($temp_id);
        $guest = Guest::where('guest_id',$id)->first();
        $ads = Ads::where('template_id',$temp_id)->where('target_gender',$guest->gender)->where('target_age','LIKE','%'.$guest->age.'%')->first();
        $feedback = json_decode($temp->Field->feedback_fields);
        if(isset($feedback) && $feedback->comment!=1 || $feedback->rate!=1 || $feedback->survey!=1)
        {   
            $ap = Session::get('ap');
            $site = Session::get('site');
            $site_data = Site::where('site_code',$site)->first();

            if ($guest->type==2) {
                $this->authorizeGuest($site,$site_data->time_limit,$ap,$site_data->speed_limit,$site_data->speed_limit,$site_data->data_limit);
            }
        }

        return view('frontend.feedback',compact('temp','id','ads'));
    }

    public function detail($id)
    {
        $guest = Guest::find($id);
        $guests = Guest::where('user_ap',$guest->user_ap)->orderBy('guest_id','desc')->get();
        
        return view('backend.guest.detail',compact('guests'));
    }

    public function postFeedback(Request $request,$id)
    {   
        $ap = Session::get('ap');
        $site = Session::get('site');
        $temp_id = Session::get('template');
        $temp = Template::find($temp_id);
        $site_data = Site::where('site_code',$site)->first();
        foreach ($temp->Rating as $key => $value) {
            $values[] = $request[$value->Rate->label];
            $keys[] = $value->Rate->label;
        }
        
        $guest = Guest::find($id);
        
        $guest->update(['comment'=>$request->comment,'rating_key'=>json_encode($keys),'rating_value'=>json_encode($values),'status'=>ACTIVE]);

        for ($i=0; $i < count($temp->Surveying); $i++) { 
            if($request['answer'.$i]!=null){
                $ans = Answer::find($request['answer'.$i]);
                $survey = new Survey;
                $survey->guest_id = $id;
                $survey->answer = $ans->label;
                $survey->question = $temp->Surveying[$i]->Question->label;
                $survey->status = ACTIVE;
                $survey->save();
            }
        }

        if (array_sum($values)<=6) {
            mailSending($guest);
        }

        if ($guest->type==2) {
            $this->authorizeGuest($site,$site_data->time_limit,$ap,$site_data->speed_limit,$site_data->speed_limit,$site_data->data_limit);
        }
        //if($this->authorizeGuest($site,$site_data->timeout_limit,$ap,$site_data->speed_limit,$site_data->speed_limit,$site_data->data_limit)==true){
            header('Location: '.$temp->Field->url);
            exit();
        //}

        //return back();
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
        $user_ap = Session::get('user_ap');
        $guest = Guest::where('user_ap',$user_ap)->get()->last();
        $site_info = Site::where('site_code',$site)->first();
        $define_minute = $site_info->time_limit+$site_info->timeout_limit;
        Movement::MovementStore($site_info->site_id);
        $date_time = new DateTime();
        $curr_datetime_format = $date_time->format('Y-m-d H:i:s');
        if ($guest!=null) {
            $guest_created_format = $guest->created_at->format('Y-m-d H:i:s');
            $format_1 = datetime_convert($curr_datetime_format,$site_info->time_limit);
            $format_2 = datetime_convert($guest_created_format,$define_minute);
                //dd($format_1);
            if ($format_1 <= $format_2) {
                return redirect('500');
            }                
        }       

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
        
        $guestId = $this->firstCreated();
        $gender = 1;
        if ($provider=='facebook') {
            $gender = $social_user->user['gender']=='male'?1:2;
        }
        $guest = Guest::find($guestId['id'])->update([
            'name'=>$social_user->getName(),
            'email'=>$social_user->getEmail(),
            'social_id'=>$social_user->getId(),
            //'phone'=>$request->phone,
            'gender' => $gender,
            'profile_photo' => $social_user->getAvatar(),
            'type' => SOCIAL,
            'status'=>INACTIVE,
            'os'=>$guestId['os']
        ]);

        return redirect('guest/feedback/'.$guestId['id']);
    }

    public function socialUserAge(Request $request)
    {
        $age = avgAge($request->age);
        Guest::find($request->id)->update(['age'=>$age]);
    }

    public static function firstCreated()
    {        
        $site = Session::get('site');
        $user_ap = Session::get('user_ap');
        $os_type = Session::get('os_type');

        $guest = new Guest;
        $guest->site_id = Site::where('site_code',$site)->value('site_id');
        $guest->user_ap = $user_ap;
        $guest->status = ACTIVE;
        $guest->os = detectOS($os_type);
        $guest->save();
        $data['id'] =$guest->guest_id;
        $data['os'] = $guest->os;

        return $data;
    }

    public static function authorizeGuest($id,$minutes,$ap_mac,$up=NULL,$down=NULL,$mb=NULL)
    {   
        $api = new Unifi;
        $api->user = unifiUser;
        $api->password = unifiPass;
        $api->baseurl = unifiServer;        
        $api->site = $id;
        if ($api->login($ap_mac,$minutes,$up,$down,$mb)==true) {
            $api->logout();
            return true;
        }        

        return false;
    }

    public function postExport(Request $request)
    {       
        // if (count($request->id)==0) {
        //     Flash::error('please select at least one');
        //     return back();
        // }
        for ($i=0; $i < count($request->id); $i++) { 
            $value[] = Guest::where('guest_id',$request->id[$i])->select('name','email','gender','age','phone','site_id','social_id','user_ap','rating_key','rating_value','created_at')->first()->toArray();
        }
        $key = ['Name','Email','Phone','Social ID','Device Map','Site','Gender','Age','Rating Key','Rating Value','Created At'];

        $headers = array(
            'Content-Type' => 'text/csv',
        );
        $filename = "guest_infos.csv";
        $gender = Lookup::where('title','GENDER')->pluck('value','key');
        $age_group = Lookup::where('title','Age Group')->pluck('value','key');
        
        convert_csv($filename,$key,$value,$gender,$age_group);

        return response()->download('csv/'.$filename, $filename, $headers);
    }
}
