<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\BusinessAccount;
use App\Model\Category;
use App\Model\SubCategory;
use App\Model\AdPost;
use App\Model\AdManager;

class BusinessController extends Controller
{
    public function category($link){
        $banners=AdManager::where(['fk_page_id'=>2,'status'=>1])->get()->keyBy('serial_num');
        $category=Category::where('link',$link)->first();
        if($category==null){
            return redirect()->back();
        }
        $businessCategory=Category::select('id','name','icon_photo','icon_class','link')->where('status',1)->where('type',2)->orderBy('serial_num','ASC')->get();
        foreach ($businessCategory as $key => $value) {
            $businessSubCategory[$value->id]=SubCategory::where('status',1)->where('fk_category_id',$value->id)->get();
        }
        $business=BusinessAccount::leftJoin('users','business_account.fk_user_id','users.id')->leftJoin('sub_category','business_account.fk_sub_category_id','sub_category.id')->where('sub_category.fk_category_id',$category->id)->select('users.name','business_account.*')->where(['business_account.status'=>1,'business_account.is_approved'=>1])->paginate(20);
        $page_title=$category->short_description;
        \Session::put('title_msg',$category->name);
        \Session::put('metaDescription',$category->description);
        return view('frontend.business.index',compact('businessCategory','businessSubCategory','business','category','banners','page_title'));
    }
    public function index($link,$id){
    	$banners=AdManager::where(['fk_page_id'=>2,'status'=>1])->get()->keyBy('serial_num');
        $category=SubCategory::leftJoin('category','sub_category.fk_category_id','category.id')->where('sub_category.id',$id)->select('category.name','sub_category.*')->first();
        if($category==null){
        	return redirect()->back();
        }
    	$businessCategory=Category::select('id','name','icon_photo','icon_class','link')->where('status',1)->where('type',2)->orderBy('serial_num','ASC')->get();
        foreach ($businessCategory as $key => $value) {
            $businessSubCategory[$value->id]=SubCategory::where('status',1)->where('fk_category_id',$value->id)->get();
        }
        $business=BusinessAccount::leftJoin('users','business_account.fk_user_id','users.id')->where('fk_sub_category_id',$id)->select('users.name','business_account.*')->where(['business_account.status'=>1,'business_account.is_approved'=>1])->paginate(20);
        \Session::put('title_msg',$category->sub_category_name);
        \Session::put('metaDescription',$category->description);
    	return view('frontend.business.index',compact('businessCategory','businessSubCategory','business','category','banners'));
    }
    public function show($link)
    {
        $banners=AdManager::where(['fk_page_id'=>5,'status'=>1])->get()->keyBy('serial_num');
        $data=BusinessAccount::leftJoin('users','business_account.fk_user_id','users.id')->leftJoin('sub_category','business_account.fk_sub_category_id','sub_category.id')->select('business_account.*','users.name','sub_category_name')->where('link',$link)->first();
        if($data==null){
            return redirect()->back();
        }
        $adPost=AdPost::leftJoin('post_photo','ad_post.id','post_photo.fk_post_id')
                ->leftJoin('sub_category','ad_post.fk_sub_category_id','sub_category.id')
                ->leftJoin('category','sub_category.fk_category_id','category.id')
                ->leftJoin('last_step_category','ad_post.fk_last_step_id','last_step_category.id')
                ->select('ad_post.*','sub_category_name','last_step_category_name','post_photo.photo_one','category.name as cat_name')
                ->where('ad_post.created_by',$data->fk_user_id)
                ->where('ad_post.status',1)
                ->where('ad_post.is_approved',1)
                ->orderBy('ad_post.id','DESC')
                ->paginate(10);
        $about=strip_tags($data->description);
        $about = preg_replace("/&#?[a-z0-9]+;/i","",$about);
        $service=strip_tags($data->services);
        $service = preg_replace("/&#?[a-z0-9]+;/i","",$service);
        //return $service;
        \Session::put('title_msg',$data->name);
        \Session::put('metaDescription',$data->name.', '.$data->title.', '.$about);
        \Session::put('metaKeyword',$data->name.', '.$data->title.', '.$service);
        $metaKeyword=$data->name.', '.$data->title.', '.$service;
        return view('frontend.business.show',compact('data','adPost','metaKeyword','banners'));
    }
    public function all(){
        $banners=AdManager::where(['fk_page_id'=>2,'status'=>1])->get()->keyBy('serial_num');
        $businessCategory=Category::select('id','name','icon_photo','icon_class','link')->where('status',1)->where('type',2)->orderBy('serial_num','ASC')->get();
        foreach ($businessCategory as $key => $value) {
            $businessSubCategory[$value->id]=SubCategory::where('status',1)->where('fk_category_id',$value->id)->get();
        }
        $business=BusinessAccount::leftJoin('users','business_account.fk_user_id','users.id')->select('users.name','business_account.*')->where(['business_account.status'=>1,'business_account.is_approved'=>1])->paginate(30);
        \Session::put('title_msg','Business Directory in Bangladesh');
        \Session::put('metaDescription','Online Market marketplace in Bangladesh
Address bazar, Yellow Pages, Trade Listing, Bangladesh Directory, Free Classifieds,
online marketplace in bangladesh, 
bangladesh ecommerce site list, 
online stores in bangladesh,
online bazar in bangladesh, 
Companies in Bangladesh, 
Business Directory of Bangladesh,
online business listing of bangladeshi companies,
email addresses & websites,
sales & purchase, price,
advertising a business,
find company address,
bangladesh, address & phone,
the business directory of find companies email address,
Bangladesh Companies and Services,');
        return view('frontend.business.index',compact('businessCategory','businessSubCategory','business','category','banners'));
    }
public function directory(){
    $banners=AdManager::where(['fk_page_id'=>8,'status'=>1])->get()->keyBy('serial_num');
    $businessCategory=Category::select('id','name','short_Description','link')->where('status',1)->where('type',2)->orderBy('serial_num','ASC')->get();
        foreach ($businessCategory as $key => $value) {
            $businessSubCategory[$value->id]=SubCategory::where('status',1)->where('fk_category_id',$value->id)->simplePaginate(2);
        }
        \Session::put('title_msg','Business Directory in Bangladesh');
        \Session::put('metaDescription','Online Market marketplace in BangladeshAddress bazar, Yellow Pages, Trade Listing, Bangladesh Directory, Free Classifieds,online marketplace in bangladesh, bangladesh ecommerce site list, online stores in bangladesh,online bazar in bangladesh, Companies in Bangladesh, Business Directory of Bangladesh,online business listing of bangladeshi companies,email addresses & websites,sales & purchase, price,advertising a business,find company address,bangladesh, address & phone,the business directory of find companies email address,Bangladesh Companies and Services,');
    return view('frontend.directory',compact('businessCategory','businessSubCategory','banners'));
}










}
