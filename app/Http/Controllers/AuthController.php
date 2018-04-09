<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\AdPost;
use App\User;
use App\Model\UserInfo;
use Auth;
use DB;

class AuthController extends Controller
{
    public function login(){
    	return view('frontend.auth.login');
    }
    public function register(){
    	$type=DB::table('user_type')->where('type','!=',1)->where('type','!=',2)->orderBy('type_name','ASC')->pluck('type_name','type');

    	return view('frontend.auth.register',compact('type'));
    }
    public function userInfo(){
        return view('frontend.auth.userInfo');
    }
    public function varifyEmailDone($email,$verify){
       $user=User::where(['email'=>$email,'verifyToken'=>$verify])->first();
       if($user){
        User::where(['email'=>$email,'verifyToken'=>$verify])->update(['email_verified'=>1,'verifyToken'=>null]);
        return redirect('profile')->with('success','Your email is now verified.');
       }else{

        return redirect('/')->with('error','These credentials do not match our records.');
       }
    }

    







}
