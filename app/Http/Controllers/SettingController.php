<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Lookup;
use App\Models\Servey;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Guest;
use App\User;
use Flash,Auth,Mail,Session;

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

    public function getServey($type)
    {
        if ($type=='questions') {
            $datas = Question::orderBy('question_id','desc')->paginate(20);
        }else
        {
            $datas = Answer::orderBy('answer_id','desc')->paginate(20);
        }
        $question = Question::all();

        return view('backend.setting.servey',compact('datas','type','question'));
    }

    public function postServey(Request $request,$type,$id=0)
    {
        if ($type=='questions') {
            $question = ($id>0)?Question::find($id):new Question;
            $question->label = $request->label;
            $question->slug = $request->slug;
            $question->created_by = Auth::id();
            $question->save();
        }else
        {
            $answer = ($id>0)?Answer::find($id):new Answer;
            $answer->label = $request->label;
            $answer->slug = $request->slug;
            $answer->created_by = Auth::id();
            $answer->question_id = $request->question_id;
            $answer->save();
        }
        Flash::success('Successfully saving servey');
        return back();
    }    

    public function emailTest(){
        return view('backend.setting.mail');
    }

    public function emailTesting()
    {   
        $user = User::find(Auth::id());
        $app_user = ['name'=>$user->name,'email'=>$user->email];
        
        Mail::send('mail.test', ['user' => $app_user], function ($message) use ($app_user)
        {                           
            $message->to($app_user['email'], $app_user['name'])->subject('Testing Email from Nexus');
        });

        Flash::success('Success your email testing');

        return back();
    }
}

