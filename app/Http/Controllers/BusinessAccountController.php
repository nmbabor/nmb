<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\AdPost;
use App\User;
use App\Model\UserInfo;
use App\Model\Category;
use App\Model\SubCategory;
use App\Model\BusinessAccount;
use Auth;
use Validator;

class BusinessAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        
    }
    public function index()
    {
        if(Auth::user()->type!=4){
            return redirect()->back();
        }
        $business=BusinessAccount::where('fk_user_id',Auth::user()->id)->count();
        if($business>0){
            return redirect('business-account/profile');
        }
        $timestamp = strtotime('next Saturday');
        $days = array();
        for ($i = 0; $i < 7; $i++) {
            $days[strftime('%A', $timestamp)] = strftime('%A', $timestamp);
            $timestamp = strtotime('+1 day', $timestamp);
        }
        $category=Category::where('status',1)->where('type',2)->pluck('name','id');
        $profile=User::findOrFail(Auth::user()->id);
        $userInfo=UserInfo::where('fk_user_id',Auth::user()->id)->first();
        return view('frontend.auth.business.create',compact('profile','userInfo','days','category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->type!=4){
            return redirect()->back();
        }
        $business=BusinessAccount::where('fk_user_id',Auth::user()->id)->count();
        if($business>0){
            return redirect('business-account/profile');
        }
        $timestamp = strtotime('next Saturday');
        $days = array();
        for ($i = 0; $i < 7; $i++) {
            $days[strftime('%A', $timestamp)] = strftime('%A', $timestamp);
            $timestamp = strtotime('+1 day', $timestamp);
        }
        $category=Category::where('status',1)->where('type',2)->pluck('name','id');
        $profile=User::findOrFail(Auth::user()->id);
        $userInfo=UserInfo::where('fk_user_id',Auth::user()->id)->first();
        return view('frontend.auth.business.create',compact('profile','userInfo','days','category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input=$request->all();
        $link=str_replace(' , ', '-', $input['link']);
        $link=str_replace(', ', '-', $link);
        $link=str_replace(' ,', '-', $link);
        $link=str_replace(',', '-', $link);
        $link=str_replace('/', '-', $link);
        $link=rtrim($link,' ');
        $link=str_replace(' ', '-', $link);
        $link=str_replace('.', '', $link);
        
        $link=strtolower($link);
        $input['link']=$link;
        $validator = Validator::make($input, [
                    'name' => 'required',
                    'title' => 'required',
                    'location' => 'required',
                    'fk_category_id' => 'required',
                    'fk_sub_category_id' => 'required',
                    'description' => 'required',
                    'services' => 'required',
                    'contact_email' => 'required',
                    'contact_phone' => 'required',
                    'cover_photo' => 'required|image',
                    'profile_photo' => 'required|image',
                    'link' => 'required|unique:business_account|max:50',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                }
            $input['open_hour']=date('h:i A',strtotime($request->open_hour)).' - '.date('h:i A',strtotime($request->close_hour));
            $input['fk_user_id']=Auth::user()->id;
           $photos=BusinessAccount::photoUpload($request);
            if(isset($photos['cover_photo'])){
                $input['cover_photo']=$photos['cover_photo'];
            }
            if(isset($photos['profile_photo'])){
                $input['profile_photo']=$photos['profile_photo'];
            }
        BusinessAccount::create($input);
        User::where('id',Auth::user()->id)->update(['name'=>$input['name'],'type'=>4]);
        try{
        $bug=0;
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
        }
         if($bug==0){
        return redirect()->back()->with('success','Data Successfully Inserted');
        }elseif($bug==1062){
            return redirect()->back()->with('error','The name has already been taken.');
        }else{
            return redirect()->back()->with('error','Something Error Found ! ');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()->type!=4){
            return redirect()->back();
        }
        $data=BusinessAccount::leftJoin('users','business_account.fk_user_id','users.id')->leftJoin('sub_category','business_account.fk_sub_category_id','sub_category.id')->select('business_account.*','users.name','sub_category_name')->where('fk_user_id',Auth::user()->id)->first();
        if($data==null){
            return redirect()->back();
        }
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

        return view('frontend.auth.business.show',compact('data','adPost'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->type!=4){
            return redirect()->back();
        }
        $data=BusinessAccount::leftJoin('users','business_account.fk_user_id','users.id')->leftJoin('sub_category','business_account.fk_sub_category_id','sub_category.id')->select('business_account.*','users.name','sub_category_name','fk_category_id')->where('fk_user_id',Auth::user()->id)->first();
        if($data==null){
            return redirect()->back();
        }
        $subCat=SubCategory::where('fk_category_id',$data->fk_category_id)->pluck('sub_category_name','id');
        $openHour=explode(' - ',$data->open_hour);
        $hour=array(
            'open_hour'=>date('H:i',strtotime($openHour[0])),
            'close_hour'=>date('H:i',strtotime($openHour[1]))
            );
        $timestamp = strtotime('next Saturday');
        $days = array();
        for ($i = 0; $i < 7; $i++) {
            $days[strftime('%A', $timestamp)] = strftime('%A', $timestamp);
            $timestamp = strtotime('+1 day', $timestamp);
        }
        $category=Category::where('status',1)->where('type',2)->pluck('name','id');
        return view('frontend.auth.business.edit',compact('days','category','data','subCat','hour'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input=$request->all();
        $link=str_replace(' , ', '-', $input['link']);
        $link=str_replace(', ', '-', $link);
        $link=str_replace(' ,', '-', $link);
        $link=str_replace(',', '-', $link);
        $link=str_replace('/', '-', $link);
        $link=rtrim($link,' ');
        $link=str_replace(' ', '-', $link);
        $link=str_replace('.', '', $link);
        $link=strtolower($link);
        $input['link']=$link;
        $validator = Validator::make($input, [
                    'name' => 'required',
                    'title' => 'required',
                    'location' => 'required',
                    'fk_category_id' => 'required',
                    'fk_sub_category_id' => 'required',
                    'description' => 'required',
                    'services' => 'required',
                    'contact_email' => 'required',
                    'contact_phone' => 'required',
                    'cover_photo' => 'image',
                    'profile_photo' => 'image',
                    'link' => "required|unique:business_account,link,$id|max:50",
                ]);
                if ($validator->fails()) {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                }
            $input['open_hour']=date('h:i A',strtotime($request->open_hour)).' - '.date('h:i A',strtotime($request->close_hour));
            if($input['website']!=null){
                $website=str_replace('http://','',$input['website']);
                $input['website']='http://'.$website;
            }
             $photos=BusinessAccount::photoUpdate($request);
            if(isset($photos['cover_photo'])){
                $input['cover_photo']=$photos['cover_photo'];
            }
            if(isset($photos['profile_photo'])){
                $input['profile_photo']=$photos['profile_photo'];
            }
            $input['is_approved']=0;
            User::where('id',Auth::user()->id)->update(['name'=>$input['name']]);
            if(isset($input['_method'])){
                unset($input['_method']);
            }
            if(isset($input['_token'])){
                unset($input['_token']);
            }
            if(isset($input['name'])){
                unset($input['name']);
            }
            if(isset($input['fk_category_id'])){
                unset($input['fk_category_id']);
            }if(isset($input['close_hour'])){
                unset($input['close_hour']);
            }
            $data=BusinessAccount::where('fk_user_id',Auth::user()->id);
            $data->update($input);
        try{
            $bug=0;
        }catch(\Exception $e){
            $bug = $e->errorInfo[1]; 
        }
        if($bug==0){
        return redirect()->back()->with('success','Data Successfully Updated');
        }elseif($bug==1062){
            return redirect()->back()->with('error','The name has already been taken.');
        }else{
            return redirect()->back()->with('error','Something Error Found ! ');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function loadSubCat($id)
    {
        $subCat=SubCategory::where('fk_category_id',$id)->pluck('sub_category_name','id');
        return view('frontend.auth.business.loadSubCategory',compact('subCat'));
    }
}
