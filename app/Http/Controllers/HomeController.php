<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Guest;
use App\Models\Site;
use App\Models\Client;
use App\Models\Movement;
use DB,Auth,Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $timein = date('Y-m-d G:i:s',strtotime('-1 hour'));
        $timeout = date('Y-m-d G:i:s');
        $data['active'] = Guest::whereBetween('created_at',[$timein,$timeout])->count();

        if (Auth::user()->role==1) {   
            $data['active'] = Guest::whereBetween('created_at',[$timein,$timeout])->count();       
            $data['guests'] = Guest::count();
            $data['sites'] = Site::pluck('site_name','site_id');
            $data['clients'] = Client::count();
            $data['visit'] = Movement::count(); 
            // $data['login'] = Guest::select(DB::raw('count(guest_id) as `data`'),DB::raw("CONCAT_WS('-',MONTH(created_at),YEAR(created_at)) as monthyear"))
            //        ->groupby('monthyear')
            //        ->get();
            $data['login'] = Guest::select(DB::raw('count(guest_id) as `data`'),DB::raw('HOUR(created_at) as time'))
                    ->whereDate('created_at', '=', Carbon::today()->toDateString())
                    ->groupBy('time')
                   ->get();
                  
            $data['male'] = Guest::where('gender',1)->select(DB::raw("count(age) as `total`"),'age')
                    ->groupBy('age')
                    ->get();

            $data['female'] = Guest::where('gender',2)->select(DB::raw("count(age) as `total`"),'age')
                    ->groupBy('age')
                    ->get();

            $data['os_type'] = Guest::select(DB::raw('count(guest_id) as `data`'),'os')
                   ->groupby('os')
                   ->get();
        }else{
            $client_id = Client::where('user_id',Auth::id())->first();
            $site_id = json_decode($client_id->site_id);
            $data['active'] = Guest::whereIn('site_id',$site_id)->whereBetween('created_at',[$timein,$timeout])->count();
            $data['guests'] = Guest::whereIn('site_id',$site_id)->count();
            $data['sites'] = Site::whereIn('site_id',$site_id)->pluck('site_name','site_id');
            $data['visit'] = Movement::whereIn('site_id',$site_id)->count();

            // $data['login'] = Guest::whereIn('site_id',$site_id)->select(DB::raw('count(guest_id) as `data`'),DB::raw("CONCAT_WS('-',MONTH(created_at),YEAR(created_at)) as monthyear"))
            //        ->groupby('monthyear')
            //        ->get();
            $data['login'] = Guest::whereIn('site_id',$site_id)->select(DB::raw('count(guest_id) as `data`'),DB::raw('HOUR(created_at) as time'))
                    ->whereDate('created_at', '=', Carbon::today()->toDateString())
                    ->groupBy('time')
                   ->get();

            $data['male'] = Guest::whereIn('site_id',$site_id)->where('gender',1)->select(DB::raw("count(age) as `total`"),'age')
                    ->groupBy('age')
                    ->get();

            $data['female'] = Guest::whereIn('site_id',$site_id)->where('gender',2)->select(DB::raw("count(age) as `total`"),'age')
                    ->groupBy('age')
                    ->get();

            $data['os_type'] = Guest::whereIn('site_id',$site_id)->select(DB::raw('count(guest_id) as `data`'),'os')
                   ->groupby('os')
                   ->get();
        }
        return view('backend.index',compact('data'));
    }

    public function searchData(Request $request)
    {   
        $search_date = [date('Y-m-d G:i:s',strtotime($request->from_date)),date('Y-m-d G:i:s',strtotime($request->to_date))];
        $timein = date('Y-m-d G:i:s',strtotime('-1 hour'));
        $timeout = date('Y-m-d G:i:s');

        if (Auth::user()->role==1) {   
            $data['active'] = Guest::whereBetween('created_at',[$timein,$timeout])->count();      
            $data['guests'] = Guest::whereBetween('created_at',$search_date)->count();
            $data['sites'] = Site::whereBetween('created_at',$search_date)->count();
            $data['clients'] = Client::whereBetween('created_at',$search_date)->count();
            $data['visit'] = Movement::whereBetween('created_at',$search_date)->count();
            
            $data['login'] = Guest::whereBetween('created_at',$search_date)->select(DB::raw('count(guest_id) as `data`'),DB::raw('HOUR(created_at) as time'))
                    ->groupBy('time')
                    ->get();
            $data['male'] = Guest::whereBetween('created_at',$search_date)->where('gender',1)->select(DB::raw("count(age) as `total`"),'age')
                    ->groupBy('age')
                    ->orderBy('age','desc')
                   ->get();
            $data['female'] = Guest::whereBetween('created_at',$search_date)->where('gender',2)->select(DB::raw("count(age) as `total`"),'age')
                    ->groupBy('age')
                    ->orderBy('age','desc')
                   ->get();
            $data['os_type'] = Guest::whereBetween('created_at',$search_date)->select(DB::raw('count(guest_id) as `data`'),'os')
                   ->groupby('os')
                   ->get();
        }else{
            $client_id = Client::where('user_id',Auth::id())->first();
            $site = json_decode($client_id->site_id);
            $site_id = [$request->site];
            $data['guests'] = Guest::whereIn('site_id',$site_id)->whereBetween('created_at',$search_date)->count();
            $data['active'] = Guest::whereIn('site_id',$site_id)->whereBetween('created_at',[$timein,$timeout])->count();
           
            $data['sites'] = Site::whereIn('site_id',$site)->pluck('site_name','site_id');
            $data['clients'] = Client::whereIn('site_id',$site_id)->whereBetween('created_at',$search_date)->count();
            $data['visit'] = Movement::whereIn('site_id',$site_id)->whereBetween('created_at',$search_date)->count();
            
            $data['login'] = Guest::whereIn('site_id',$site_id)->whereBetween('created_at',$search_date)->select(DB::raw('count(guest_id) as `data`'),DB::raw('HOUR(created_at) as time'))
                ->groupBy('time')
                ->get();

            $data['male'] = Guest::whereIn('site_id',$site_id)->whereBetween('created_at',$search_date)->where('gender',1)->select(DB::raw("count(age) as `total`"),'age')
                    ->groupBy('age')
                    ->orderBy('age','desc')
                   ->get();
            $data['female'] = Guest::whereIn('site_id',$site_id)->whereBetween('created_at',$search_date)->where('gender',2)->select(DB::raw("count(age) as `total`"),'age')
                    ->groupBy('age')
                    ->orderBy('age','desc')
                   ->get();
            $data['os_type'] = Guest::whereIn('site_id',$site_id)->whereBetween('created_at',$search_date)->select(DB::raw('count(guest_id) as `data`'),'os')
                   ->groupby('os')
                   ->get();
        }
        
        return view('backend.index',compact('data'));
    }

    public function jsonIndex()
    {        
        $data['login'] = Guest::select(DB::raw('count(guest_id) as `data`'),DB::raw("CONCAT_WS('-',MONTH(created_at),YEAR(created_at)) as monthyear"))
               ->groupby('monthyear')
               ->get();

        $data['male'] = Guest::where('gender',1)->select(DB::raw("count(age) as `total`"),'age')
                ->groupBy('age')
                ->orderBy('age')
               ->get();
        $data['female'] = Guest::where('gender',2)->select(DB::raw("count(age) as `total`"),'age')
                ->groupBy('age')
                ->orderBy('age')
               ->get();
        
        $data['register'] = Guest::where('type',REGISTER)->count();
        $data['social'] = Guest::where('type',SOCIAL)->count();

        return response()->json(['data'=>$data]);
    }
}
