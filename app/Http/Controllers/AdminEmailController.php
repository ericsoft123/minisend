<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class AdminEmailController extends Controller
{
    //
    public function admin_count_all(Request $request)//display count on display
    {
        if(Auth::guard('Admin')->check()){
          //
          //$check = DB::select("SELECT (SELECT COUNT('id') FROM  users) as a, (SELECT *FROM message_counters ) as b");
          $check=DB::select("SELECT COUNT('id') as counter_user FROM  users");
          if($check)
          {
              $get_message_counters=DB::select("SELECT * FROM message_counters where id=1");
             return response([
                 "status"=>true,
                 "result"=>[
                     "user_counter"=>$check[0]->counter_user,
                     "message_counter"=>$get_message_counters,
                    
                 ],
             
                 
                
             
             ],200);
          }
          else{
             return response([
                 "status"=>false,
               
             
             ],201);
          }
          //
        }
        else{
            return response([
                "status"=>false,
                "error"=>"0",
                    ],201);
        }
    }
    public function admin_view_clients(Request $request)//view all clients
    {
        if(Auth::guard('Admin')->check()){
            $check = DB::select("select *from users order by id desc limit 10");
            if($check)
            {
               return response([
                   "status"=>true,
                   "result"=>$check
               
                   
                  
               
               ],200);
            }
            else{
               return response([
                   "status"=>false,
                 
               
               ],201);
            }
        }
        else{
            return response([
                "status"=>false,
                "error"=>"0",
                    ],201);
        }
    }
    public function admin_count_user(Request $request)//this is display user email he has (posted,sent,failed)
    {
        $input=$request->all();
        $userid=$input['userid'];
        $table_uid=$input['table_uid'];
        if(Auth::guard('Admin')->check()){
         //
         $posted_emails=$table_uid."_".'posted_emails';
$sent_emails=$table_uid."_".'sent_emails';
$failed_emails=$table_uid."_".'failed_emails';
         $check = DB::select("SELECT (SELECT COUNT('id') FROM $posted_emails where userid='$userid') as a, (SELECT COUNT('id') FROM $sent_emails where userid='$userid') as b, (SELECT COUNT('id') FROM $failed_emails where userid='$userid') as c");
         if($check)
         {
            return response([
                "status"=>true,
                "result"=>[
                    "posted_email"=>$check[0]->a,
                    "sent_email"=>$check[0]->b,
                    "failed_email"=>$check[0]->c,
                ],
            
                
               
            
            ],200);
         }
         else{
            return response([
                "status"=>false,
              
            
            ],201);
         }
         //
        }
        else{
            return response([
                "status"=>false,
                "error"=>"0",
                    ],201);
        }
    }
    public function admin_search_client(Request $request)//admin search clients
    {
        $search_input=$request->input('search_input');
        if(Auth::guard('Admin')->check()){
            $check = DB::select("select *from users where name LIKE '%$search_input%' or country LIKE '%$search_input%' or country_code LIKE '%$search_input%' limit 10");
            if($check)
            {
               return response([
                   "status"=>true,
                   "result"=>$check
               
                   
                  
               
               ],200);
            }
            else{
               return response([
                   "status"=>false,
                 
               
               ],201);
            }
        }
        else{
            return response([
                "status"=>false,
                "error"=>"0",
                    ],201);
        }
    }
    public function admin_view_user(Request $request)//display number in every country
    {
        if(Auth::guard('Admin')->check()){
            $check = DB::select("select *from table_partitions limit 100");
            if($check)
            {
               return response([
                   "status"=>true,
                   "result"=>$check
               
                   
                  
               
               ],200);
            }
            else{
               return response([
                   "status"=>false,
                 
               
               ],201);
            }
        }
        else{
            return response([
                "status"=>false,
                "error"=>"0",
                    ],201);
        }
    }
    
}
