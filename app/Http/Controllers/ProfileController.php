<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class ProfileController extends Controller// profile
{

    
    public function __construct()
    {
        date_default_timezone_set(env('TIME_ZONE'));
        $this->today = date('Y-m-d H:i:s', time());
       $this->creator=env('Super');
       $this->limit_distance=env('LIMIT_DISTANCE');
  
        
    }
    public function profile(){
        if(Auth::check()){
            return view('profilepage');
        }
        else if(Auth::guard('Admin')->check()){
            return view('profilepage');
        }
        else{
            return view('homepage');
            //echo'you are not signup';
        }

        
    }

    

}