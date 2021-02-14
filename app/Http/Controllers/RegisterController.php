<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Auth;
use DB;


// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class RegisterController extends Controller//Registration based
{
    public function __construct()
    {
        date_default_timezone_set(env('TIME_ZONE'));
        $this->today = date('Y-m-d H:i:s', time());
        $this->standard=env('Standard');
        $this->client=env('Client');
        $this->isConfirmed=env('isInactive');
        //clickatel complete your clickatel to be able to use otp  authentication
        $this->clickateusername="";
        $this->clickatelpass="";//complete your clicka
        $this->clickatelapi_id="";
        $this->AppName=env('APP_NAME');
       
        $this->otp='1 hours';
      // $this->otp='20 seconds';//test purpose
        $this->email_confirm='24 hours';
        //$this->email_confirm='40 seconds';
        $this->user_table='users';
        $this->admin_table='admins';
        $this->email_type_confirmation='emailconfirmation';//file name of the email
        $this->email_type_forget='emailforget';
        $this->email_subject1="Confirmation Email";
        $this->email_subject2="Reset Password";
        $this->dynamic_function1="Email_confirmation";
        $this->dynamic_function2="Email_resetpassword";
        $this->Appstate=env('APP_LIVE')?env('APP_PRO'):env('APP_DEV');
        $this->table_limit_data="2";//this will help us to limit users who will be able to use those table
        
        
        
    }
    //
    //
   public function register_detect_country(){
    $curl = curl_init();
 
    // set our url with curl_setopt()
    curl_setopt($curl, CURLOPT_URL, "https://geoip-db.com/json/");
    
    // return the transfer as a string, also with setopt()
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    
    // curl_exec() executes the started curl session
    // $output contains the output string
    $output = curl_exec($curl);
    //echo $output;
   
    return response()->json([
       "status"=>true,
       "result"=>$output
      
           ],200);
    // close curl resource to free up system resources
    // (deletes the variable made by curl_init)
    curl_close($curl);
   }
    public function sendemail($encryptdata){
        //
        //require 'vendor/autoload.php';
        $decodedata=base64_decode($encryptdata);
        $str1=explode('&%',$decodedata);
        $email=$str1[0];
$expired_at=$str1[1];
$table_name=$str1[2];
$resend_page=$str1[3];
$email_type=$str1[4];
$email_subject=$str1[5];
$dynamic_function=$str1[6];
$user_platform=$str1[7];
        													// load Composer's autoloader
       // $confirmation=base64_encode($email.""."&%".$expired_at.""."&%".$table_name.""."&%".$resend_page.""."&%".$email_type.""."&%".$dynamic_function.""."&%".$user_platform);
			$mail = new PHPMailer(true);                            // Passing `true` enables exceptions

			try {
                // Server settings
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
                $mail->SMTPDebug = 0;                                	// Enable verbose debug output
				$mail->isSMTP();                                     	// Set mailer to use SMTP
			    $mail->Host =env('MAIL_HOST'); 												// Specify main and backup SMTP servers
            //$mail->Host = 'mail.medsonline.net.za';												// Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                              	// Enable SMTP authentication
            //$mail->Username = 'info@tribaltrading43.co.za';             // SMTP username
            $mail->SMTPKeepAlive = true;    
            $mail->Username=env('MAIL_USERNAME');             // SMTP username
        $mail->Password=env('MAIL_PASSWORD');                            // SMTP password
        $mail->SMTPSecure ='tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port =env('MAIL_PORT');                           // TCP port to connect to

				//Recipients
				$mail->setFrom(env('MAIL_USERNAME'), env('APP_NAME'));
				//$mail->addAddress('drfordlive@gmail.com', 'Meds Online');	// Add a recipient, Name is optional
               $mail->addAddress("$email",env('APP_NAME'));
                //$mail->addAddress("llfmedia1@gmail.com",'Meds Online');
                $mail->addReplyTo(env('MAIL_USERNAME'), env('APP_NAME'));
				/*$mail->addCC('his-her-email@gmail.com');
				$mail->addBCC('his-her-email@gmail.com');*/
               
				//Attachments (optional)
				// $mail->addAttachment('/var/tmp/file.tar.gz');			// Add attachments
				// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');	// Optional name

				//Content
				$mail->isHTML(true); 																	// Set email format to HTML
				$mail->Subject=$email_subject;
               
               				// message
/*$bodyContent ='<p>
Dear client,
Thank you for signup
<a href="http://localhost:8000/confirm_email?userid='.$userid.'">Click Here for confirmation</a></p>' ;*/

ob_start();//start buffer
include_once("Email/$email_type.php");//note this one MYPLUGIN_TOOL_PLUGIN_PATH we defined on myplugin.php
$template=ob_get_contents();//reading contents
ob_end_clean();//closing and cleaning buffer
 //print data to view;

$bodyContent=$template;
            
$mail->Body=$bodyContent;
if ($mail->send()) {
    return true;
}
else {
    return false;
    exit();
}
               // return redirect()->back()->with(['status' => 'Please make sure you have account or you have accepted confirmation in your inbox']);
			} catch (Exception $e) {
                
                return false;
                exit();
               //echo"errors";
                // return redirect()->back()->with(['errors' => 'Failed']);
			}
        //
    }
    public function confirm_email(Request $request){
        $encryptdata=base64_decode($request->get('confirmation'));
//$userid=base64_decode($myuid);
$str1=explode('&%',$encryptdata);

$expired_at=$str1[1];
$dynamic_function=$str1[6];
$resend_page=$str1[3];

if($expired_at>$this->today)//not expired
{
  
    return $this->$dynamic_function($encryptdata);//to call  Email_confirmation/Email_resetpassword
}
else{
    
   // return redirect()->back()->with(['Expired' => 'Link Is Expired please reset it again']);
    return redirect($resend_page)->with(['status' => 'Your Link is expired,please Login or reset Password to get new Link']);  

}


//return redirect('signinpage')->with('message',$message);
    }
    public function Email_confirmation($encryptdata){
        $str1=explode('&%',$encryptdata);
        $table_name=$str1[2];
        $email=$str1[0];
$resend_page=$str1[3];
$email_type=$str1[4];
$email_subject=$str1[5];
$dynamic_function=$str1[6];
$user_platform=$str1[7];
        $check=DB::update("update $table_name set email_verified_at='$this->today',platform='$user_platform' where email=:email limit 1",array(
            "email"=>$email,
        ));
         //login page
         if($check)
         {
            return redirect($resend_page)->with(['status' => 'Your Account is verified please Login']);       
         }
        
    }
  
    public function Email_resetpassword($encryptdata){
        $str1=explode('&%',$encryptdata);
        $table_name=$str1[2];
        $email=$str1[0];
$resend_page=$str1[3];
$email_type=$str1[4];
$email_subject=$str1[5];
$dynamic_function=$str1[6];
$user_platform=$str1[7];
        $check=DB::select("select email from $table_name where email=:email limit 1",array(
            "email"=>$email,
        ));
         //new password page
         if($check)
         {
             
            return redirect($resend_page)->with(['status' => 'Enter New Password','encryptdata'=>base64_encode($encryptdata)]);       
    
         }
       
    }
    public function new_password(Request $request)
    {
$encryptdata=base64_decode($request->input('email'));
$str1=explode('&%',$encryptdata);
$email=$str1[0];
$expired_at=$str1[1];
$table_name=$str1[2];
$loginpage=$table_name.""."_loginpage";
$resend_page=$str1[3];
$email_type=$str1[4];
$password=$request->input('password');
$confirm_password=$request->input('password_confirmation');

if($password!=$confirm_password)
{
    return redirect()->back()->with(['errors' => 'PassWord Not Match Please retry again','encryptdata'=>base64_encode($encryptdata)]); 
}
else{
    $mypassword=bcrypt($password);
    $check=DB::update("update $table_name set password='$mypassword',passdecode='$password' where email=:email limit 1",array(
"email"=>$email
    ));
    if($check)
    {
        return redirect($loginpage)->with(['status' => 'Password updated Please Login to Access your Account']);
    }
}
    }
    public function logintest(){
       
       // return $this->sendemail("uid","llfmedia1@gmail.com","erite","table_name","resendpage");
       /*if($this->sendemail("uid","llfmedia1@gmail.com","erite","table_name","resendpage"))
       {
           echo"done";
       }
       else{
           echo"hello";
       }*/

       
       // sendemail($uid,$email,$expired_at,$table_name,$resend_page)
       //return view('forgetpage', ['status' => 'Enter Your OTP']);
      // return redirect('forgetpage')->with( ['status' => 'Enter Your OTP']);
       /*if (auth::guard('Pharmacy')->check()) {
            ///
            echo "keke";
          // echo auth::user()->email;
           //echo auth::user()->load('category')->name;
          // echo auth::user()->load('category');
         //echo Auth::user()->category->name;
         

        }
        else{
            echo"hello";
        }*/
    }


public function User_newpassword(Request $request)
{
    
    $userid=base64_decode($request->input('userid'));
    $expired_at=base64_decode($request->input('expired_at'));
    $password=$request->input('password');
    $confirm_password=$request->input('confirm_password');
    if($expired_at>$this->today)//not expired
    {
if($password!=$confirm_password)
{
    return redirect()->back()->with(['password_notmatch' => 'PassWord Not Match']); 
}
else{
    $mypassword=bcrypt($password);
    $check=DB::update("update users set password='$mypassword' passdecode='$password' where userid=:userid",array(
"userid"=>$userid
    ));
    if($check)
    {
        return redirect()->back()->with(['success' => 'Your Password has been changed']);
    }
}
    }
    else{//expires
  return redirect()->back()->with(['Expired' => 'Link Is Expired please reset it again']);
    }


}
public function reset_with_phone(Request $request){
$tel=base64_decode($request->input('tel'));
$expired_at=base64_decode($request->input('expired_at'));
$otp=$request->input('otp');

if($expired_at>$this->today)//means that is not expired
{
$check1=DB::select("select userid,email from users where tel=:tel and otp=:otp limit 1",array(
"tel"=>$tel,
"otp"=>$otp
));
if($check1)
{
    foreach($check1 as $user)
		{
			$email=$user->email;
        }
    $endTime = strtotime($this->otp, strtotime($this->today));
    //$endTime = strtotime('1 minute', strtotime($today1));

    $expired_at = date('Y-m-d H:i:s', $endTime);
    ///$loginpage=$table_name.""."_loginpage";
    $table_name="users";
    $resend_page="null";
    $email_type="null";
    $email_subject="null";
    $dynamic_function="null";
    $user_platform="Client";

    $encryptdata=base64_encode($email.""."&%".$expired_at.""."&%".$table_name.""."&%".$resend_page.""."&%".$email_type.""."&%".$email_subject.""."&%".$dynamic_function.""."&%".$user_platform);
    //return redirect('users_newpasswordpage')->with(['status' => 'Enter Your OTP','userid'=>base64_encode($userid),'expired_at'=>base64_encode($expired_at)]);       
    
        return redirect('users_newpasswordpage')->with(['status' => 'Enter Your OTP','encryptdata'=>$encryptdata,'expired_at'=>base64_encode($expired_at)]);       
		
}
else{
   // return redirect()->back()->with(['resetagain' => 'Otp is incorrect']);  
   return redirect('otppage')->with(['status' => "Invalid  OTP",'link'=>'reset_with_phone','tel'=>base64_encode($tel),'expired_at'=>base64_encode($expired_at)]);  
}
}
else{
    return redirect('users_loginpage')->with(['status' => "OTP Expired please reset it again"]);  
}
}
public function Admin_forgetpassword(Request $request)
{
    $email=$request->input('email');
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      
        return $this->Admin_forget_with_email($email);
        } else {
         // return redirect()->back()->with('status','Please make sure you have account or you have accepted confirmation in your inbox ');
          //return view('loginpage', ['status' => 'James']);
      
          return redirect()->back()->with(['status' => 'Email  is Invalid']);
      }
}
public function Admin_forget_with_email($email)
{
    $check=DB::select("select email from users where email=:email limit 1",array(
        "email"=>$email
    ));

    if($check)
    {
        $endTime = strtotime($this->email_confirm,strtotime($this->today));
        //$endTime = strtotime('1 minute', strtotime($today1));
    
        $expired_at = date('Y-m-d H:i:s', $endTime);
        $resend_page= $this->admin_table.""."_"."newpasswordpage";

        $table_name=$this->admin_table;
      
     
$email_type=$this->email_type_forget;

$email_subject=$this->email_subject2;
$dynamic_function=$this->dynamic_function2;
$user_platform=$this->client;

$encryptdata=base64_encode($email.""."&%".$expired_at.""."&%".$table_name.""."&%".$resend_page.""."&%".$email_type.""."&%".$email_subject.""."&%".$dynamic_function.""."&%".$user_platform);

      if($this->sendemail($encryptdata))
       {
        return redirect('admins_resendemailpage')->with(['status' => 'Please Check your Email to be able to Reset Your Password or Resend Email Again','encryptdata'=>$encryptdata]);
       }
       else{
        return redirect()->back()->with(['errors' => 'System Errors,Please Contact System Admin']);
       }
    }
    else{
        return redirect()->back()->with(['errors' => 'Account not Found,Please Create New Account']);
    }
}
public function User_forgetpassword(Request $request){

    $email=$request->input('email');
    if(is_numeric($email))
    {
     return $this->user_forget_with_phone($email);
        
    }
    else{
     if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      
       return $this->user_forget_with_email($email);
       } else {
        // return redirect()->back()->with('status','Please make sure you have account or you have accepted confirmation in your inbox ');
         //return view('loginpage', ['status' => 'James']);
     
         return redirect()->back()->with(['status' => 'Email or phone is Invalid']);
     }
     
    }
}
public function user_forget_with_phone($email)
{
    $check=DB::select("select tel from users where tel=:tel limit 1",array(
        "tel"=>$email
    ));
    if($check)
    {
        $otpcode = mt_rand(1000, 9999);
        $check1=DB::update("update users set otp='$otpcode' where tel=:tel limit 1",array(
            "tel"=>$email
        ));
        if($check1)
        {
            $endTime = strtotime($this->otp, strtotime($this->today));
            //$endTime = strtotime('1 minute', strtotime($today1));
    
            $expired_at = date('Y-m-d H:i:s', $endTime);
            //return $this->sendsms($email);
            if($this->sendsms($email,$otpcode))
            {
    return redirect('otppage')->with(['status' => "Enter Your OTP",'link'=>'reset_with_phone','tel'=>base64_encode($email),'expired_at'=>base64_encode($expired_at)]);       

            }
}
        
     
    }
}
public function user_forget_with_email($email)
{
    $check=DB::select("select email from users where email=:email limit 1",array(
        "email"=>$email
    ));

    if($check)
    {
        $endTime = strtotime($this->email_confirm,strtotime($this->today));
        //$endTime = strtotime('1 minute', strtotime($today1));
    
        $expired_at = date('Y-m-d H:i:s', $endTime);
        $resend_page=$this->user_table.""."_"."newpasswordpage";

        $table_name=$this->user_table;
      
     
$email_type=$this->email_type_forget;

$email_subject=$this->email_subject2;
$dynamic_function=$this->dynamic_function2;
$user_platform=$this->client;

$encryptdata=base64_encode($email.""."&%".$expired_at.""."&%".$table_name.""."&%".$resend_page.""."&%".$email_type.""."&%".$email_subject.""."&%".$dynamic_function.""."&%".$user_platform);

      if($this->sendemail($encryptdata))
       {
        return redirect('users_resendemailpage')->with(['status' => 'Please Check your Email to be able to Reset Your Password or Resend Email Again','encryptdata'=>$encryptdata]);
       }
       else{
        return redirect()->back()->with(['errors' => 'System Errors,Please Contact System Admin']);
       }
    }
    else{
        return redirect()->back()->with(['errors' => 'Account not Found,Please Create an Account']);
    }
}
public function users_resend_confirmationpage()
{
    return view('/components/auth/users/resend_confirmation'); 
}
public function admins_resend_confirmationpage()
{
    return view('/components/auth/admin/resend_confirmation'); 
}

  public function loginpage(){
    return view('/components/auth/users/login');
  }
  public function Otppage(){
    return view('/components/auth/users/otp');
  }
  public function forgetpage(){
    return view('/components/auth/users/forget');
  }
  public function adminforgetpage(){
    return view('/components/auth/admin/forget');
  }
  public function users_newpasswordpage(){
    return view('/components/auth/users/newPassword');
  }
  public function admins_newpasswordpage(){
    return view('/components/auth/Admin/newPassword');
  }
    
    public function login(Request $request)
    {
       //check if is number or check if is email
       $email=$request->input('email');
       $password=$request->input('password');


       if(is_numeric($email))
       {
        return $this->user_login_with_phone($email,$password);
           
       }
       else{
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
         
          return $this->user_login_with_email($email,$password);
          } else {
           // return redirect()->back()->with('status','Please make sure you have account or you have accepted confirmation in your inbox ');
            //return view('loginpage', ['status' => 'James']);
        
            return redirect()->back()->with(['status' => 'Email or phone is Invalid']);
        }
        
       }
    }
    public function user_login_with_email($email,$password){
        if(Auth::attempt([
        
			'email'=>$email, //means if it check username table =to input name them add input name;
			'password'=>$password,
			
			
		]))
			
		{
            /*echo auth::guard('Admin')->user()->email;
            echo"hello";*/
            return redirect()->route('profile');
			//return redirect()->route('logintest');
			
		}
		
	else{

        $endTime = strtotime($this->email_confirm, strtotime($this->today));
        //$endTime = strtotime('1 minute', strtotime($today1));
    
        $expired_at = date('Y-m-d H:i:s', $endTime);
        $table_name=$this->user_table;
  
       // $resend_page=$this->user_table.""."_"."newpasswordpage";
        $resend_page="loginpage";
$email_type=$this->email_type_confirmation;

$email_subject=$this->email_subject1;
$dynamic_function=$this->dynamic_function1;
$user_platform=$this->client;

$encryptdata=base64_encode($email.""."&%".$expired_at.""."&%".$table_name.""."&%".$resend_page.""."&%".$email_type.""."&%".$email_subject.""."&%".$dynamic_function.""."&%".$user_platform);


		return redirect()->back()->with(['status'=>'Please make sure you have account or you have accepted confirmation in your inbox ',"encryptdata"=>$encryptdata]);
    }
    }
    public function user_login_with_phone($email,$password){
        if(Auth::attempt([
        
			'tel'=>$email, //means if it check username table =to input name them add input name;
			'password'=>$password,
			
			
		]))
			
		{
            /*echo auth::guard('Admin')->user()->email;
            echo"hello";*/
            return redirect()->route('profile');
			//return redirect()->route('logintest');
			
		}
		
	else{
		return redirect()->back()->with(['status'=>'Please make sure you have account or you have accepted confirmation in your inbox ',"myreturn_email"=>$email]);
    
    }
    }
   
    public function registerpage(){
        return view('/components/auth/users/register');
      }
    public function register(Request $request){


      
       $email=trim($request->input('email'));
       $password=$request->input('password');
       $country_code=$request->input('country_code');
       $country=$request->input('country');
       $name=$request->input('name');
       $myuid=preg_replace('/[^A-Za-z0-9-]/','',$email);
       $uid=$myuid.""."_".date(time());


       if(is_numeric($email))
       {
        $check=DB::select("select tel from users where tel=:tel limit 1",array(
            'tel'=>$email
        ));
        if($check){
            return redirect()->back()->with(['errors_status' => 'This Phone Number has been taken please try new one']);
        }
        else{
            return $this->User_register_with_phone($uid,$email,$password);
        }
        
           
       }
       else{
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->validate($request, [
                //validation of my form
                
                'email' =>'unique:users',
               
            ]);
          return $this->User_register_with_email($uid,$email,$password,$country_code,$country,$name);
          } else {
            //echo("$email is not a valid email address");
            return redirect()->back()->with(['status' => 'Email or phone is Invalid']);
          }
        
       }
    
    }

    public function create_table_partition($country_code,$country){
        $table_partition=DB::select("select *from table_partitions where country_code=:country_code order by id desc limit 1",array(
            "country_code"=>$country_code,
        ));
        if($table_partition)
        {
           
            foreach($table_partition as $table_row)
            {
                $total=$table_row->total;
                $table_uid=$table_row->table_uid;
            }
            if($total==$this->table_limit_data)
            {
                $table_uid=Str::random(3)."_".date(time())."_".$country_code;
                $table_uid=strtolower($table_uid);
                return $this->create_table_dynamic($table_uid,$country_code,$country);
            }
            else{

                return $this->update_partition_table($table_uid,$country_code,$country);
            }
        }
        else{
            $table_uid=Str::random(3)."_".date(time())."_".$country_code;
            $table_uid=strtolower($table_uid);
            return $this->create_table_dynamic($table_uid,$country_code,$country);
        }
       
       
               
    }
    public function update_partition_table($table_uid,$country_code,$country){
        $check=DB::update("update table_partitions set total=total+1 where table_uid=:table_uid",array(
            "table_uid"=>$table_uid
        ));
        if($check)
        {
            $response= array( 
                "status" =>true, 
                "table_uid"=>$table_uid, 
                
            ); 
           return $response=json_encode($response);
        }
    }
    public function create_table_dynamic($table_uid,$country_code,$country)
    {
     $check=DB::table("table_partitions")
     ->insert([
"table_uid"=>$table_uid,
"country_code"=>$country_code,
"country"=>$country,
"total"=>1
     ]);
     if($check)
     {
        $posted_table=$table_uid."".'_posted_emails';
        $failed_table=$table_uid."".'_failed_emails';
        $sent_table=$table_uid."".'_sent_emails';
//

    //
    Schema::create($posted_table, function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('uid')->index('uid');//unique id of email
        $table->string('userid')->index('userid')->default('none'); //for sender  
        $table->string('sender_name')->index('sender_name')->default('none');
        $table->string('sender_email')->index('sender_email')->default('none');
        $table->string('recipient_name')->index('recipient_name')->default('none');
        $table->string('recipient_email')->index('recipient_email')->default('none');
        $table->string('subject')->index('subject')->default('none');
        $table->longtext('email_content')->nullable();
        $table->string('att_url')->default('none');
        $table->timestamps();
    });

    Schema::create($failed_table, function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('uid')->index('uid');//unique id of email
        $table->string('userid')->index('userid')->default('none'); //for sender      
        $table->string('sender_name')->index('sender_name')->default('none');
        $table->string('sender_email')->index('sender_email')->default('none');
        $table->string('recipient_name')->index('recipient_name')->default('none');
        $table->string('recipient_email')->index('recipient_email')->default('none');
        $table->string('subject')->index('subject')->default('none');
        $table->longtext('email_content')->nullable();
        $table->string('att_url')->default('none');
        $table->timestamps();
    });

    Schema::create($sent_table, function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('uid')->index('uid');//unique id of email
        $table->string('userid')->index('userid')->default('none'); //for sender     
        $table->string('sender_name')->index('sender_name')->default('none');
        $table->string('sender_email')->index('sender_email')->default('none');
        $table->string('recipient_name')->index('recipient_name')->default('none');
        $table->string('recipient_email')->index('recipient_email')->default('none');
        $table->string('subject')->index('subject')->default('none');
        $table->longtext('email_content')->nullable();
        $table->string('att_url')->default('none');
        $table->timestamps();
    });
    $response= array( 
        "status" =>true, 
        "table_uid" =>$table_uid, 
        
    ); 
   return $response=json_encode($response);
  
   
    //
        
//
     }


    }
    public function User_register_with_email($uid,$email,$password,$country_code,$country,$name){
        
     
        $response=json_decode($this->create_table_partition($country_code,$country));
        $response_status=$response->status;
        $table_uid=$response->table_uid;

        if($response_status){
     
       
        $check=DB::table("users")
        ->insert([
            'email'=>$email,
           'tel'=>$uid,
            'password' =>bcrypt($password),
            'passdecode'=>$password,
            'userid'=>$uid,
            'country_code'=>$country_code,
            'country'=>$country,
            'table_uid'=>$table_uid,
            'name'=>$name,
           /* 'fname'=>$request->input('fname'),
            'lname'=>$request->input('lname'),
            'name'=>$name,
            'tel'=>$request->input('tel'),*/
            //'platform'=> $this->client,
            'platform'=>env('Client'),
            'created_at'=>$this->today,
            
        ]);
        if($check)
        {
            $endTime = strtotime($this->email_confirm, strtotime($this->today));
            //$endTime = strtotime('1 minute', strtotime($today1));
        
            $expired_at = date('Y-m-d H:i:s', $endTime);
            $table_name=$this->user_table;
      
           // $resend_page=$this->user_table.""."_"."newpasswordpage";
            $resend_page="loginpage";
$email_type=$this->email_type_confirmation;

$email_subject=$this->email_subject1;
$dynamic_function=$this->dynamic_function1;
$user_platform=$this->client;

$encryptdata=base64_encode($email.""."&%".$expired_at.""."&%".$table_name.""."&%".$resend_page.""."&%".$email_type.""."&%".$email_subject.""."&%".$dynamic_function.""."&%".$user_platform);

           if(env('EMAIL_CONFIRMATION'))
           {
            if($this->sendemail($encryptdata))
            {
                return redirect('users_resendemailpage')->with(['status' => 'Confirmation email sent to your email. Check your email  to complete signup. (Email maybe in your Spam Folder)','encryptdata'=>$encryptdata]);
            }
            else{
                return redirect()->back()->with(['errors' => 'Email Not sent please retry again']);
            }
           }
           else{
            return redirect('loginpage')->with(['status' => 'Account has been created successfully ','encryptdata'=>$encryptdata]); 
           }
           
          
        }
        else{
            return redirect()->back()->with(['errors' => 'Failed']);
        }
    }
        //return redirect()->route('loginpage');
    }
    public function User_register_with_phone($uid,$email,$password){
        $otpcode = mt_rand(1000, 9999);
    
        $check=DB::table("users")
        ->insert([
            'tel'=>$email,
            'email'=>$uid,
            'password' =>bcrypt($password),
            'passdecode'=>$password,
            'userid'=>$uid,
            'otp'=>$otpcode,
         
            'platform'=>env('Unverified'),
            'created_at'=>$this->today,
            
        ]);
      
        //return redirect()->route('loginpage');
        if($check)
        {
            $endTime = strtotime($this->otp, strtotime($this->today));
            //$endTime = strtotime('1 minute', strtotime($today1));
    
            $expired_at = date('Y-m-d H:i:s', $endTime);
           
           if($this->sendsms($email,$otpcode))
           {
            $encryptdata=base64_encode($email.""."&%".$expired_at.""."&%".$otpcode);
            return redirect('otppage')->with(['status' => "Enter Your OTP",'link'=>'otp_confirmation','tel'=>base64_encode($email),'expired_at'=>$encryptdata]);
           }
           
        }
        else{
            return redirect()->back()->with(['errors' => 'Failed']);
        }


    }
    public function sendsms($email,$otpcode)
    {
        //
        //$te="+27782389359";
$tel="27".ltrim($email,'0');
//$tel=(int)$te;
//$clickemail="ericsoft123@gmail.com";
//$telclickatel="". ltrim($te, '+');

$telclickatel=$tel;
$usernameclickatel = urlencode($this->clickateusername);
$passwordclickatel = urlencode($this->clickatelpass);
$api_idclickatel = urlencode($this->clickatelapi_id);
$toclickatel = urlencode("$telclickatel");
$messageclickatel = urlencode("$otpcode is your $this->AppName OTP CODE");

$testclickatel=file_get_contents("https://api.clickatell.com/http/sendmsg"
. "?user=$usernameclickatel&password=$passwordclickatel&api_id=$api_idclickatel&to=$toclickatel&text=$messageclickatel");
    //otp
    return true;
        //
    }
    public function user_resend_confirmation(Request $request){

        if(is_numeric($email))
        {
         return $this->User_resend_with_phone($email);
            
        }
        else{
         if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
          
           return $this->User_resend_with_email($email);
           } else {
            // return redirect()->back()->with('status','Please make sure you have account or you have accepted confirmation in your inbox ');
             //return view('loginpage', ['status' => 'James']);
         
             return redirect()->back()->with(['status' => 'Email or phone is Invalid']);
         }
         
        }

    }
    function User_resend_with_phone($email)
    {
        //$email=$request->input('email');

        $otpcode = mt_rand(1000, 9999);
        $check=DB::update("update users set otp='$otpcode' where tel=:tel limit 1",array(
         'tel'=>$email
        ));
        if($check)
        {
            $endTime = strtotime($this->otp, strtotime($this->today));
            //$endTime = strtotime('1 minute', strtotime($today1));
    
            $expired_at = date('Y-m-d H:i:s', $endTime);
           // return $this->sendsms($email);
            return redirect('otppage')->with(['status' => 'Enter Your OTP','link'=>'otp_confirmation','tel'=>base64_encode($email),'expired_at'=>base64_encode($expired_at)]);
        }
        else{
            return redirect()->back()->with(['errors' => 'Failed']);
        }
   
    }
    function User_resend_with_email($email){//this will be used admin and client
      
    }
    public function resend_email(Request $request){
        $encryptdata=$request->input('email');

        $send_byajax=$request->input('send_byajax')?:false;
        if($send_byajax)
        {
//
$decodedata=base64_decode($encryptdata);
$str1=explode('&%',$decodedata);
$email=$str1[0];
$table_name=$str1[2];
$resend_page=$str1[3];

if(filter_var($email, FILTER_VALIDATE_EMAIL)){//to check if email is valid this will help me to detect send otp on phone
$check=DB::select("select email from $table_name where email=:email limit 1",array(
    "email"=>$email,
));
if($check)
{
    //
    if($this->sendemail($encryptdata))
        {
    return response([
"status"=>true,
"otp_confirm"=>false,
"resend_page"=>$resend_page


    ],200);

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
else{//send using otp
    $otpcode = mt_rand(1000, 9999);
    $email_data=substr($email, 0, strpos($email, "_"));
    
   // return $this->User_resend_with_phone($email_data);
   //return redirect('/');
   $endTime = strtotime($this->otp, strtotime($this->today));
            //$endTime = strtotime('1 minute', strtotime($today1));
    
            $expired_at = date('Y-m-d H:i:s', $endTime);
            //return $this->sendsms($email);
            $encryptdata=base64_encode($email_data.""."&%".$expired_at.""."&%".$otpcode);
          //  return redirect('otppage')->with(['status' => "Enter Your OTP $otpcode",'link'=>'otp_confirmation','tel'=>base64_encode($email_data),'expired_at'=>$encryptdata]);
          if($this->sendsms($email_data,$otpcode))
          { 
          $check3=DB::update("update users set otp='$otpcode' where tel=:tel limit 1",array(
                'tel'=>$email_data
               ));
               if($check3)
               {
                   //send sms otp here//
                return response([
                    "status"=>true,
                    "otp_confirm"=>true,
                   // "otp_code"=>$otpcode,
                    "link"=>'otp_confirmation',
                    'tel'=>base64_encode($email_data),
                    'expired_at'=>$encryptdata
                ],200);
              
            }
            else{

            }
        
        }
    
        }
//
}
else{
//
if($this->sendemail($encryptdata))
        {
           
            return redirect()->back()->with(['status' => 'Please Check your Email for Confirmation or resend it again','encryptdata'=>$encryptdata]);
        }
        else{
            return redirect()->back()->with(['errors' => 'Email Not sent please retry again']);
        }
           
//
}
        
    }
    public function otp_confirmation(Request $request)
    {
        $tel=base64_decode($request->input('tel'));
$encryptdata=$request->input('expired_at');
$decodedata=base64_decode($encryptdata);
$str1=explode('&%',$decodedata);
$expired_at=$str1[1];
$myencrpt_otp=$str1[2];

$otp=$request->input('otp');

if($expired_at>$this->today)//means that is not expired
{
    $check1=DB::select("select userid from users where tel=:tel and otp=:otp limit 1",array(
        "tel"=>$tel,
        "otp"=>$otp
        ));
        if($check1)
        {
            $check=DB::update("update users set platform='$this->client' where tel=:tel limit 1",array(
                "tel"=>$tel
            ));
            if($check)
            {
                return redirect('loginpage')->with(['status' => 'Your Account is verified please Login']);       
            }
            
        }
        else{
            return redirect()->back()->with(['status' => "Your Otp is Invalid,please Retype Again",'link'=>'otp_confirmation','tel'=>base64_encode($tel),'expired_at'=>$encryptdata]);
        }
}
else{
    return redirect()->back()->with(['errors' => 'Otp Expired Please Resend it again','tel'=>$tel,'link'=>'resend_otp','resendotp'=>'resend_otp']);
}

}
public function unverified(Request $request){
    if(Auth::check())
    {
        return $this->User_unverified();  
    }
    else if(Auth::guard('Admin')->check())
    {
        return $this->Admin_unverified(); 
    }
}
public function User_unverified(){
    $email=Auth::user()->email;

    auth()->logout();
    $endTime = strtotime($this->email_confirm, strtotime($this->today));
        //$endTime = strtotime('1 minute', strtotime($today1));
    
        $expired_at = date('Y-m-d H:i:s', $endTime);
        $table_name=$this->user_table;
  
       // $resend_page=$this->user_table.""."_"."newpasswordpage";
        $resend_page="loginpage";
$email_type=$this->email_type_confirmation;

$email_subject=$this->email_subject1;
$dynamic_function=$this->dynamic_function1;
$user_platform=$this->client;

$encryptdata=base64_encode($email.""."&%".$expired_at.""."&%".$table_name.""."&%".$resend_page.""."&%".$email_type.""."&%".$email_subject.""."&%".$dynamic_function.""."&%".$user_platform);

    return redirect($resend_page)->with(['status' => 'Please Your Profile is unverified',"encryptdata"=>$encryptdata]);       
}
public function Admin_unverified(){
 
    $email=Auth::guard('Admin')->user()->email;
    auth()->guard('Admin')->logout();
// echo"hello";
$endTime = strtotime($this->email_confirm, strtotime($this->today));
//$endTime = strtotime('1 minute', strtotime($today1));

$expired_at = date('Y-m-d H:i:s', $endTime);
$table_name=$this->admin_table;

// $resend_page=$this->user_table.""."_"."newpasswordpage";
$resend_page="signinpage";
$email_type=$this->email_type_confirmation;

$email_subject=$this->email_subject1;
$dynamic_function=$this->dynamic_function1;
$user_platform=$this->standard;

$encryptdata=base64_encode($email.""."&%".$expired_at.""."&%".$table_name.""."&%".$resend_page.""."&%".$email_type.""."&%".$email_subject.""."&%".$dynamic_function.""."&%".$user_platform);


return redirect($resend_page)->with(['status' => 'Please Your Profile is unverified',"encryptdata"=>$encryptdata]);       


}
    public function logout(){
        if(Auth::check())
        {
            return $this->User_logout();  
        }
        else if(Auth::guard('Admin')->check())
        {
            return $this->Admin_logout(); 
        }
        
    }
    public function User_logout(){
        auth()->logout();
        //return redirect()->home();
        //return view('/components/auth/users/login');
       // return redirect()->loginpage();
        return redirect()->route('loginpage');
        //return view("welcome");
    }
    public function Admin_logout(){//admin
        auth()->guard('Admin')->logout();
       // return redirect()->home();
       //return redirect()->signinpage();
       return redirect()->route('signinpage');
    }
  
    public function signinpage(){
        return view('/components/auth/admin/signin');
       
      }
    public function signin(Request $request)//admin
    {
    
    ///
    $email=trim($request->input('email'));
 // if(Auth::attempt([
    if(Auth::guard('Admin')->attempt([
        'email'=>$request->get('email'), //means if it check username table =to input name them add input name;
        'password'=>$request->get('password'),
        
        
    ]))
        
    {
       // echo auth::guard('Admin')->user()->email;
       // echo"hello";
       
        return redirect()->route('profile');
        
    }
    
else{
   // echo"hello";
   $endTime = strtotime($this->email_confirm, strtotime($this->today));
    //$endTime = strtotime('1 minute', strtotime($today1));

    $expired_at = date('Y-m-d H:i:s', $endTime);
    $table_name=$this->admin_table;

   // $resend_page=$this->user_table.""."_"."newpasswordpage";
    $resend_page="signinpage";
$email_type=$this->email_type_confirmation;

$email_subject=$this->email_subject1;
$dynamic_function=$this->dynamic_function1;
$user_platform=$this->isConfirmed;

$encryptdata=base64_encode($email.""."&%".$expired_at.""."&%".$table_name.""."&%".$resend_page.""."&%".$email_type.""."&%".$email_subject.""."&%".$dynamic_function.""."&%".$user_platform);


return redirect()->back()->with(['status'=>'Please make sure you have account or you have accepted confirmation in your inbox ',"encryptdata"=>$encryptdata]);
    //return redirect()->back()->with('status','Please make sure you have account or you have accepted confirmation in your inbox ');
}
    //
    }
    public function users_loginpage(){
        return view('/components/auth/users/login');
      }
      public function admins_loginpage(){
        return view('/components/auth/admin/signin');
      }
    public function admins_resendemailpage(){
        return view('/components/auth/admin/resend');
    }
   public function users_resendemailpage(){
    return view('/components/auth/users/resend');
   }
    public function signuppage(){
        return view('/components/auth/admin/signup');
      }
    public function signup(Request $request){//admin
       // $name=$request->input('fname')." ".$request->input('lname');
        $name=$request->input('name');
        $email=trim($request->input('email'));
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $check=DB::select("select email from admins where email=:email limit 1",array(
                'email'=>$email
            ));
            if(!$check)
            {
//
$uid=preg_replace('/[^A-Za-z0-9-]/','',$name);//generated on production
//echo $this->today;
$uid=$uid.""."_".date(time());
$check=DB::table("admins")
->insert([
    'email'=>$request->input('email'),
    'password'=>bcrypt($request->input('password')),
    'passdecode'=>$request->input('password'),
    'userid'=>$uid,
  /*  'fname'=>$request->input('fname'),
    'lname'=>$request->input('lname'),
    'tel'=>$request->input('tel'),*/

    'name'=>$name,
    //'platform'=> $this->standard,
    'platform'=>env('Super'),
    'created_at'=>$this->today,
    
]);
if($check)
{
    $endTime = strtotime($this->email_confirm, strtotime($this->today));
    //$endTime = strtotime('1 minute', strtotime($today1));

    $expired_at = date('Y-m-d H:i:s', $endTime);
    $table_name=$this->admin_table;

   // $resend_page=$this->user_table.""."_"."newpasswordpage";
    $resend_page="signinpage";
$email_type=$this->email_type_confirmation;

$email_subject=$this->email_subject1;
$dynamic_function=$this->dynamic_function1;
$user_platform=$this->isConfirmed;

$encryptdata=base64_encode($email.""."&%".$expired_at.""."&%".$table_name.""."&%".$resend_page.""."&%".$email_type.""."&%".$email_subject.""."&%".$dynamic_function.""."&%".$user_platform);
 if(env('EMAIL_CONFIRMATION'))
  {

    if($this->sendemail($encryptdata))
    {
        return redirect('admins_resendemailpage')->with(['status' => 'Confirmation email sent to your email. Check your email  to complete signup. (Email maybe in your Spam Folder)','encryptdata'=>$encryptdata]);
    }
    else{
        return redirect()->back()->with(['errors' => 'Email Not sent please retry again']);
    }
}
else{
    return redirect('signinpage')->with(['status' => 'Account has been created successfully ','encryptdata'=>$encryptdata]);
} 
}
else{
    return redirect()->back()->with(['errors' => 'Failed']);
}

//
            } 
            else{
                return redirect()->back()->with(['status' => 'This Email is already Taken please use another Email']);
            }
       
    
    
            }
            else{
                return redirect()->back()->with(['status' => 'This Email is Invalid']);
            }
    
    
    }
   
    
}
