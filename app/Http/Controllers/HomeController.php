<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Guest;
use App\Models\Site;
use App\Models\Client;
use App\Models\Movement;
use DB;

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
        $data['guests'] = Guest::count();
        $data['sites'] = Site::count();
        $data['clients'] = Client::count();
        $data['visit'] = Movement::count();
        //$data['register'] = Guest::where('type',REGISTER)->count();
        //$data['social'] = Guest::where('type',SOCIAL)->count();
        $data['login'] = Guest::select(DB::raw('count(guest_id) as `data`'),DB::raw("CONCAT_WS('-',MONTH(created_at),YEAR(created_at)) as monthyear"))
               ->groupby('monthyear')
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
        
        return view('backend.index',compact('data'));
    }

    public function searchData(Request $request)
    {   
        $search_date = [date('Y-m-d G:i:s',strtotime($request->from_date)),date('Y-m-d G:i:s',strtotime($request->to_date))];
       
        $data['guests'] = Guest::whereBetween('created_at',$search_date)->count();
        $data['sites'] = Site::whereBetween('created_at',$search_date)->count();
        $data['clients'] = Client::whereBetween('created_at',$search_date)->count();
        $data['visit'] = Movement::whereBetween('created_at',$search_date)->count();
        $data['register'] = Guest::whereBetween('created_at',$search_date)->where('type',REGISTER)->count();
        
        $data['social'] = Guest::whereBetween('created_at',$search_date)->where('type',SOCIAL)->count();
        $data['login'] = Guest::whereBetween('created_at',$search_date)->select(DB::raw('count(guest_id) as `data`'),DB::raw("CONCAT_WS('-',MONTH(created_at),YEAR(created_at)) as monthyear"))
               ->groupby('monthyear')
               ->get();

        $data['male'] = Guest::whereBetween('created_at',$search_date)->where('gender',1)->select(DB::raw("count(age) as `total`"),'age')
                ->groupBy('age')
                ->orderBy('age','desc')
               ->get();
        $data['female'] = Guest::whereBetween('created_at',$search_date)->where('gender',2)->select(DB::raw("count(age) as `total`"),'age')
                ->groupBy('age')
                ->orderBy('age','desc')
               ->get();
        
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
