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
        
        return view('backend.index',compact('data'));
    }

    public function jsonIndex()
    {        
        // $data['male'] = Guest::where('gender',1)->select(DB::raw('count(guest_id) as `data`'),DB::raw("CONCAT_WS('-',MONTH(created_at),YEAR(created_at)) as monthyear"))
        //        ->groupby('monthyear')
        //        ->get();
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
