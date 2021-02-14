<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: OPTIONS, HEAD, GET,POST,DELETE');

Route::get('/', function () {
    return view('/components/auth/users/login');
});
Route::get('/loadcount','EmailController@loadcount')->name('loadcount');
Route::post('/email_actions','EmailController@email_actions')->name('email_actions');
Route::get('/search_email_actions','EmailController@search_email_actions')->name('search_email_actions');
Route::get('/myemail_inbox','EmailController@myemail_inbox')->name('myemail_inbox');

Route::get('/admin_count_all','AdminEmailController@admin_count_all')->name('admin_count_all');
Route::get('/admin_view_clients','AdminEmailController@admin_view_clients')->name('admin_view_clients');
Route::get('/admin_count_user','AdminEmailController@admin_count_user')->name('admin_count_user');
Route::get('/admin_search_client','AdminEmailController@admin_search_client')->name('admin_search_client');
Route::get('/admin_view_user','AdminEmailController@admin_view_user')->name('admin_view_user');



Route::get('/users_loginpage','RegisterController@users_loginpage')->name('users_loginpage');//notification
Route::get('/admins_loginpage','RegisterController@admins_loginpage')->name('admins_loginpage');//notification
Route::get('/register_detect_country','RegisterController@register_detect_country')->name('register_detect_country');
Route::get('/users_resendemailpage','RegisterController@users_resendemailpage')->name('users_resendemailpage');//notification
Route::get('/admins_resendemailpage','RegisterController@admins_resendemailpage')->name('admins_resendemailpage');//notification
Route::post('/Admin_forgetpassword','RegisterController@Admin_forgetpassword')->name('Admin_forgetpassword');//notification
Route::post('/resend_email','RegisterController@resend_email')->name('resend_email');//notification
Route::get('/users_newpasswordpage','RegisterController@users_newpasswordpage')->name('users_newpasswordpage');//notification
Route::get('/admins_newpasswordpage','RegisterController@admins_newpasswordpage')->name('admins_newpasswordpage');//notification
Route::post('/new_password','RegisterController@new_password')->name('new_password');//notification




//Route::get('/profile','ProfileController@profile')->name('profile')->middleware('auth:Admin','auth');
Route::get('/profile','ProfileController@profile')->name('profile');

Route::get('/users_resend_confirmationpage','RegisterController@users_resend_confirmationpage')->name('users_resend_confirmationpage');
Route::get('/admins_resend_confirmationpage','RegisterController@admins_resend_confirmationpage')->name('admins_resend_confirmationpage');
Route::post('/reset_with_phone','RegisterController@reset_with_phone')->name('reset_with_phone');
Route::post('/User_forgetpassword','RegisterController@User_forgetpassword')->name('User_forgetpassword');
Route::get('/unverified','RegisterController@unverified')->name('unverified');
Route::get('/logout','RegisterController@logout')->name('logout');
//Route::get('/logout','RegisterController@logout')->name('logout');
Route::get('/logintest','RegisterController@logintest')->name('logintest');
Route::get('/test','TestController@test')->name('test');
/* users Action */
/*user Authentiation */
Route::get('/confirm_email','RegisterController@confirm_email')->name('confirm_email');
Route::post('/User_newpassword','RegisterController@User_newpassword')->name('User_newpassword');
Route::get('/sendemail','RegisterController@sendemail')->name('sendemail');
Route::post('/login','RegisterController@login')->name('login');

Route::get('/otppage','RegisterController@otppage')->name('otppage');
Route::post('/otp_confirmation','RegisterController@otp_confirmation')->name('otp_confirmation');
Route::get('/adminforgetpage','RegisterController@adminforgetpage')->name('adminforgetpage');
Route::get('/forgetpage','RegisterController@forgetpage')->name('forgetpage');
Route::get('/loginpage','RegisterController@loginpage')->name('loginpage');
Route::post('/register','RegisterController@register')->name('register');
Route::get('/registerpage','RegisterController@registerpage')->name('registerpage');
/*user Authentiation */


/*admin Authentication*/
Route::post('/signin','RegisterController@signin')->name('signin');
Route::get('/signinpage','RegisterController@signinpage')->name('signinpage');
Route::post('/signup','RegisterController@signup')->name('signup');
Route::get('/signuppage','RegisterController@signuppage')->name('signuppage');

/*admin Authentication*/










