<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Model\UserInfo;
use App\Model\DivisionTown;
use App\Model\Area;
use App\Model\AdPost;
use App\Model\BusinessAccount;
use App\User;
use Validator;
use Hash;

class ProfileController extends Controller
{
    public function profile(){
        $area=array();
        $profile=User::findOrFail(Auth::user()->id);
        $userInfo=UserInfo::where('fk_user_id',Auth::user()->id)->first();
        $totalAd=AdPost::where('created_by',Auth::user()->id)->count();
    	$division=DivisionTown::where('status',1)->where('type',1)->orderBy('name','ASC')->pluck('name','id')->toArray();
        $town=DivisionTown::where('status',1)->where('type',2)->orderBy('name','ASC')->pluck('name','id')->toArray();
        $division_town=array(
            'Town'=>$town,
            'Division'=>$division,
            );
        if(isset($userInfo->fk_division_id)){

        $area=Area::where('status',1)->where('fk_division_id',$userInfo->fk_division_id)->orderBy('area_name','ASC')->pluck('area_name','id');
        }
        $type=DB::table('user_type')->where('type',Auth::user()->type)->value('type_name');
    	return view('frontend.profile.profile',compact('profile','division_town','area','type','totalAd','userInfo'));
    }

    public function myAds(){
        $totalAd=AdPost::where('created_by',Auth::user()->id)->count();
        $adPost=AdPost::leftJoin('post_photo','ad_post.id','post_photo.fk_post_id')
        		->leftJoin('sub_category','ad_post.fk_sub_category_id','sub_category.id')
        		->leftJoin('category','sub_category.fk_category_id','category.id')
        		->leftJoin('last_step_category','ad_post.fk_last_step_id','last_step_category.id')
        		->select('ad_post.*','sub_category_name','last_step_category_name','post_photo.photo_one','category.name as cat_name')
        		->where('ad_post.created_by',Auth::user()->id)
        		->where('ad_post.status',1)
        		->where('ad_post.is_approved',1)
        		->orderBy('ad_post.id','DESC')
        		->get();
        	$title='My';
            $business=BusinessAccount::where('fk_user_id',Auth::user()->id)->first();
    	return view('frontend.profile.myAds',compact('totalAd','adPost','title','business'));
    }
    public function pendingAds(){
        $totalAd=AdPost::where('created_by',Auth::user()->id)->count();
        $adPost=AdPost::leftJoin('post_photo','ad_post.id','post_photo.fk_post_id')
        		->leftJoin('sub_category','ad_post.fk_sub_category_id','sub_category.id')
        		->leftJoin('category','sub_category.fk_category_id','category.id')
        		->leftJoin('last_step_category','ad_post.fk_last_step_id','last_step_category.id')
        		->select('ad_post.*','sub_category_name','last_step_category_name','post_photo.photo_one','category.name as cat_name')
        		->where('ad_post.created_by',Auth::user()->id)
        		->where('ad_post.status',1)
        		->where('ad_post.is_approved','!=',1)
        		->orderBy('ad_post.id','DESC')
        		->get();
        $title='Pending';
        $business=BusinessAccount::where('fk_user_id',Auth::user()->id)->first();
      
    	return view('frontend.profile.myAds',compact('totalAd','adPost','title','business'));
    }

    public function updateProfile(Request $request){
         $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'fk_division_id' => 'required',
                    'fk_area_id' => 'required',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)
                        ->withInput();
                }
        $input=$request->all();
        try{
            $data=UserInfo::where('fk_user_id',Auth::user()->id)->first();
            if(count($data)>0){
                $data->update([
                    'fk_division_id'=>$input['fk_division_id'],
                    'fk_area_id'=>$input['fk_area_id'],
                    'address'=>$input['address']
                    ]);
            }else{
                UserInfo::create([
                    'fk_user_id'=>Auth::user()->id,
                    'fk_division_id'=>$input['fk_division_id'],
                    'fk_area_id'=>$input['fk_area_id'],
                    'address'=>$input['address']
                    ]);
            }
            User::where('id',Auth::user()->id)->update([
                'name'=>$input['name']
                ]);
            $bug=0;
        }catch(\Exception $e){
            $bug = $e->errorInfo[1]; 
        }
        if($bug==0){
            if(Auth::user()->type==3){
                
            return redirect('resume/create')->with('success','Profile Successfully Updated. Now update your Resume.');
            }elseif(Auth::user()->type==4){
                
            return redirect('business-account')->with('success','Profile Successfully Updated. Now update your Business.');
            }elseif(Auth::user()->type==5){
                
            return redirect('eshop/create')->with('success','Profile Successfully Updated. Now update your Eshop.');
            }else{
                return redirect()->back()->with('success','Profile Successfully Updated.');
            }
        }elseif($bug==1062){
            return redirect()->back()->with('error','The email has already been taken.');
        }else{
            return redirect()->back()->with('error','Something Error Found ! ');
        }
    }
    public function changePassword(Request $request){
        $input=$request->all();
        $newPass=$input['password'];
        $data=User::findOrFail(Auth::user()->id);
        if(!empty($input['old_password'])){
            $inputOld=$input['old_password'];
            if(Hash::check($inputOld,$data['password'])){
                $validator = Validator::make($request->all(),[
                    'password' => 'required|min:6|confirmed',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                }
                $input['password']=bcrypt($newPass);

            }else{
                return redirect()->back()->with('error','Old Password not match !');
            }

        }
        try{
            $data->update($input);
            $bug=0;
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
        }
        if($bug==0){
            return redirect()->back()->with('success','Password Changed Successfully !');
        }else{
            return redirect()->back()->with('error','Something is wrong !');

        }
    }










}
