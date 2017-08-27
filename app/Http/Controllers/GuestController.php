<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;
use App\Models\Template;
use App\Models\Guest;
use App\Models\Lookup;
use Unifi,Session,Flash;

class GuestController extends Controller
{
    public function index(Request $request,$id)
    {	
        if (isset($request->id)) {
            $url = explode('/', $_SERVER['REDIRECT_URL']);
            Session::put('ap',$request->id);
            Session::put('site',$url[3]);
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
                    if ($tem->site_name==$id) {
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

        return view('frontend.index',compact('site','temp','look_age','look_gender'));
    }

    public function indexLists()
    {
        $guests = Guest::orderBy('guest_id','desc')->paginate(20);
        return view('backend.guest.index',compact('guests'));
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
        $guest->site_name = $site;
        $guest->status = INACTIVE;
        $guest->save();

        if($this->authorizeGuest($site,FIRST_AUTH,$ap)==true){
            //return response()->json(['meta'=>true,'status'=>200]);
            return redirect('guest/feedback/'.$guest->guest_id);
        }
        return back();
        //return response()->json(['meta'=>false,'status'=>500]);
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
    {   
        //$result=[];
        $ap = Session::get('ap');
        $site = Session::get('site');
        $temp_id = Session::get('template');
        $temp = Template::find($temp_id);
        $site_data = Site::where('site_name',$site)->first();
        foreach ($temp->Rating as $key => $value) {
            $values[] = $request[$value->Rate->label.'_'];
            $keys[] = $value->Rate->label;
        }
        
        Guest::find($id)->update(['comment'=>$request->comment,'rating_key'=>json_encode($keys),'rating_value'=>json_encode($values)]);

        if($this->authorizeGuest($site,$site_data->timeout_limit,$ap,$site_data->speed_limit,$site_data->speed_limit,$site_data->data_limit)==true){
            header('Location: http://www.google.com');exit();
        }
        return back();
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

}
