<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;
use DB;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailController extends Controller//client action only on email side
{
    public function __construct()
    {
        date_default_timezone_set(env('TIME_ZONE'));
        $this->today = date('Y-m-d H:i:s', time());
        $this->Appstate=env('APP_LIVE')?env('APP_PRO'):env('APP_DEV');
        $this->default_limit="";//this is default mysql limit
        $this->default_table="posted_emails";
     

    }
    //
    
    public function email_actions(Request $request){
        $input=$request->all();
       // $action_name=base64_decode($input["action_name"]);
      // $action_name=$input["action_name"];
      // return $this->$action_name($input);

      //return $this->send_email($input);
     

     
        return $this->compose_email($input);
        //return $this->upload_imag($input);
       
    
       
    }
    /*compose component Actions */
 
   
    public function upload_imag($input){
        if(isset($input['files']))
        {
            $picture=[];
            foreach($input['files'] as $file)
            {
                $filename=uniqid().$file->getClientOriginalName();
               // $file->move(public_path('upload'),$filename);
                $file->move('upload',$filename);

                //$picture[$filename];
                array_push($picture,$filename);
            }
      
               $response= array( 
                "status" =>true,
                "att_url"=>implode(",",$picture),
               ); 
           return $response=json_encode($response);
           
        }
        else{
            $response= array( 
                "status" =>false,
                "att_url"=>'none',
               ); 
           return $response=json_encode($response);
        }

    }
    public function compose_email($input){
        //validation Api
        //$uid='1';
        $uid=Str::random(8)."_".time();
       
        $table_uid=Auth::user()->table_uid;
        $att_url=json_decode($this->upload_imag($input))->att_url;
        $table_name=$table_uid."_"."posted_emails";
       

        $is_posted=json_decode($this->posted_emails($table_name,$uid,$input,$att_url));
       

      if($is_posted->status)
      {
        $is_email_sent=json_decode($this->email_sent($input,$att_url));

        if($is_email_sent->status)
        {
            $table_name=$table_uid."_"."sent_emails";
           
            $is_saved_sent=json_decode($this->sent_emails($table_name,$uid,$input,$att_url));

            if($is_saved_sent->status)
            {
                return response([
                    "status"=>true,
                    "status_num"=>$is_saved_sent->status_num
                   
                    
                   
                
                ],200);
            }
            else{
                return response([
                    "status"=>false,
                    "status_num"=>$is_saved_sent->status_num
                   
                    
                   
                
                ],201);
            }
        }
        else{

            //failed table

            $table_name=$table_uid."_"."failed_emails";
           
            $is_failed_sent=json_decode($this->failed_emails($table_name,$uid,$input,$att_url));

            if($is_failed_sent->status)
            {
                return response([
                    "status"=>true,
                    "status_num"=>$is_failed_sent->status_num
                   
                    
                   
                
                ],200);
            }
            else{
                return response([
                    "status"=>false,
                    "status_num"=>$is_failed_sent->status_num
                   
                    
                   
                
                ],201);
            }


        }



        
      }
      else{
        $table_name=$table_uid."_"."failed_emails";
        return $this->failed_emails($table_name,$uid,$input,$att_url);
      }

    }
   
    public function email_sent($input,$att_url){
        $mail = new PHPMailer(true);

    try {
        $sender_name=Auth::user()->name;
       // $email="zacspayment@dhl.com";
        $email=json_decode($input['formData'])->recipient_email;
        $recipient_name=json_decode($input['formData'])->recipient_name;
        
        //Server settings
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->SMTPDebug = 0;                     // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        //$mail->Host= env('MAIL_HOST');                    // Set the SMTP server to send through
        $mail->Host="appdev.live";                    // Set the SMTP server to send through
        $mail->SMTPAuth= true; 
        $mail->SMTPKeepAlive = true;                                    // Enable SMTP authentication
        $mail->Username=env('MAIL_USERNAME');             // SMTP username
        $mail->Password=env('MAIL_PASSWORD');                            // SMTP password
        $mail->SMTPSecure ='tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port =env('MAIL_PORT');                                  // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        //$mail->Port =465;                                  // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    
        //Recipients
    $mail->setFrom('info@appdev.live',$sender_name);
        $mail->addAddress("$email",$recipient_name);   // Add a recipient
        //$mail->addAddress('ellen@example.com');
        
        //From email address and name
         $mail->addReplyTo('info@appdev.live',$recipient_name);
       //$mail->addCC('test@example.com');
      //$mail->addBCC('appdevlive@gmail.com');
   if($att_url!='none'){
    $myattachment =explode(",",$att_url);
    for($i=0;$i<count($myattachment);$i++)
    {
      $mail->addAttachment('upload/'.$myattachment[$i]);
    }

   }
    

      //$mail->addAttachment('/upload/6027d6db87335bottle.png'); 
        // Attachments
       /* $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    */
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject =json_decode($input['formData'])->subject;
        $mail->Body    = json_decode($input['formData'])->content;
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send();
      //  echo 'Message has been sent';

        $response= array( 
            "status" =>true
           ); 
       return $response=json_encode($response);
    } catch (Exception $e) {
       // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";

       $response= array( 
        "status" =>false 
       
       
        
    ); 
   return $response=json_encode($response);
    }
    }public function posted_emails($table_name,$uid,$input,$att_url){
        $status_num=1;
        return $this->table_insert_template($table_name,$uid,$input,$att_url,$status_num);
    }
    public function sent_emails($table_name,$uid,$input,$att_url){
        $status_num=2;
        return $this->table_insert_template($table_name,$uid,$input,$att_url,$status_num);
    }
     
       
       public function failed_emails($table_name,$uid,$input,$att_url){
        $status_num=3;
           return $this->table_insert_template($table_name,$uid,$input,$att_url,$status_num);
       }
       
    public function table_insert_template($table_name,$uid,$input,$att_url,$status_num){//reusable table insert component(to avoid writing duplicate code pattern)
     
        $check=DB::table($table_name)
     ->insert([
      'uid'=>$uid,
      'userid'=>Auth::user()->userid,
      //'userid'=>'test',
      'sender_name'=>Auth::user()->name,
      'sender_email'=>Auth::user()->email,
      'recipient_name'=>json_decode($input['formData'])->recipient_name,
      'recipient_email'=>json_decode($input['formData'])->recipient_email,
      'subject'=>json_decode($input['formData'])->subject,
      'email_content'=>json_decode($input['formData'])->content,
      'att_url'=>$att_url,
      
      'created_at'=>$this->today,
     ]);
     if($check)
     {
         
        $posted_num=$status_num==1?1:0;
        $sent_num=$status_num==2?1:0;
        $failed_num=$status_num==3?1:0;
         DB::select("INSERT INTO message_counters (id,posted_email,sent_email,failed_email) VALUES(1,0,0,0) ON DUPLICATE KEY UPDATE    
         posted_email=posted_email+$posted_num,sent_email=sent_email+$sent_num,failed_email=failed_email+$failed_num");
        $response= array( 
            "status" =>true, 
            "status_num"=>$status_num,
           
            
        ); 
       return $response=json_encode($response);
      
     }
     else{
        $response= array( 
            "status" =>false, 
            "status_num"=>$status_num,
          
            
        ); 
       return $response=json_encode($response);
      
     }
    }
    
    /*compose component Actions */


    public function search_email_actions(Request $request){
        $input=$request->all();
        $table_uid=Auth::user()->table_uid;
        $action_name=$input["action_name"]=='default'?"by_".$this->default_table:"by_".$input["action_name"];
        $table_name=$input["action_name"]=='default'?$table_uid."_".$this->default_table:$table_uid."_".$input["action_name"];
        return $this->$action_name($table_name,$input);

       
    }
    public function by_failed_emails($table_name,$input){
     
        return $this->table_search_template($table_name,$input);
    }
    public function by_sent_emails($table_name,$input){
       
        
            return $this->table_search_template($table_name,$input);
    }
    public function by_posted_emails($table_name,$input)
    {
       
            return $this->table_search_template($table_name,$input);
    }
    public function table_search_template($table_name,$input){//this combine method by_failed_emails,by_sent_emails,by_posted_emails
    //this architecture is way to avoid writing duplicate code and also good way to write easy maintainable and reusable code
       
    
    $userid=Auth::user()->userid;
       /*search with uid only */
        $search_with_uid="select *from $table_name where userid='$userid' and uid=:uid order by id desc limit 10";
        $array_input_uid=array(
            "uid"=>$input["uid"]??'none',//to make default 
            
        );
    


        /*search with multiple parameters */
        $search_input=$input["search_input"];
      

        $search_multiple_params="select *from $table_name where userid='$userid' and( `sender_name` LIKE '%$search_input%' or `sender_email` LIKE '%$search_input%'  or `recipient_name` LIKE '%$search_input%' or `recipient_email` LIKE '%$search_input%' or `subject` LIKE '%$search_input%') order by id desc limit 10";
        $array_multiple_params=array(
            //to make default 
            
        );

            /*search or load by default table,when search is equal to default  this means searchinput=default*/
            $load_default_table="select *from $table_name where userid='$userid' order by id desc limit 10";
            $array_input_load_table=array(
              
                
            );
            /*search or load  by default table */

        
        $check_query=isset($input['uid'])?($searchquery=$search_with_uid and $array_input=$array_input_uid)
        :$search_input==''?($searchquery=$load_default_table and $array_input= $array_input_load_table)//this means when search input is equal empty then  $searchquery=$load_default_table and $array_input= $array_input_load_table
:($searchquery=$search_multiple_params and $array_input=$array_multiple_params);// this means when there is uid search with uid else search with other parameters
        $check=DB::select($searchquery,$array_input);
        if($check)
        {
           return response([
               "status"=>true,
               "result"=>$check,
               "name"=>isset($input['name'])?:"none",
               
              
           
           ],200);
        }
        else{
           return response([
               "status"=>false,
             
           
           ],201);
        }
    }
   

   public function loadcount(Request $request){


$table_uid=Auth::user()->table_uid;
$userid=Auth::user()->userid;
$posted_emails=$table_uid."_".'posted_emails';
$sent_emails=$table_uid."_".'sent_emails';
$failed_emails=$table_uid."_".'failed_emails';

   // $check=DB::select("select *from $table_name");
    $check = DB::select("SELECT (SELECT COUNT('id') FROM $posted_emails where userid='$userid') as a, (SELECT COUNT('id') FROM $sent_emails where userid='$userid') as b, (SELECT COUNT('id') FROM $failed_emails where userid='$userid') as c");
    if($check)
    {
       return response([
           "status"=>true,
           "result"=>[
               "posted_emails"=>$check[0]->a,
               "sent_emails"=>$check[0]->b,
               "failed_emails"=>$check[0]->c,
           ],
       
           
          
       
       ],200);
    }
    else{
       return response([
           "status"=>false,
         
       
       ],201);
    }
   }



}
