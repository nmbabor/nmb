<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\AdPost;
use App\Model\Faq;
use App\Model\Page;
use App\Model\SubCategory;
use App\Model\AdManager;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners=AdManager::where(['fk_page_id'=>1,'status'=>1])->get()->keyBy('serial_num');
        $productCategory=Category::select('id','name','icon_photo','icon_class','link','short_description')->where('status',1)->where('type',1)->orderBy('serial_num','ASC')->get();
        foreach ($productCategory as $key => $value) {
            $productCategory[$key]['ad']=AdPost::leftJoin('sub_category','ad_post.fk_sub_category_id','sub_category.id')->where('sub_category.fk_category_id',$value->id)->where('ad_post.status',1)->where('is_approved',1)->count();
        }
        $businessCategory=Category::select('id','name','icon_photo','icon_class','link')->where('status',1)->where('type',2)->orderBy('serial_num','ASC')->get();
        foreach ($businessCategory as $key => $value) {
            $businessSubCategory[$value->id]=SubCategory::where('status',1)->where('fk_category_id',$value->id)->get();
        }
        $category=array(
            'product'=>$productCategory,
            'business'=>$businessCategory,
            );
        $supports=DB::table('support')->where('status',1)->get();
        \Session::forget('title_msg');
        \Session::forget('metaDescription');
       return view('frontend.index',compact('category','supports','businessSubCategory','banners'));
    }
    public function login()
    {
        return redirect('/dashboard'); 
    }
    
    public function faq()
    {
        $faq=Faq::where('status',1)->orderBy('serial_num','ASC')->get();
        $pages=Page::where('status',1)->pluck('name','link');
        \Session::put('title_msg','FAQ');
        \Session::put('metaDescription','Frequently ask question');
        return view('frontend.faq',compact('faq','pages')); 
    }





}
