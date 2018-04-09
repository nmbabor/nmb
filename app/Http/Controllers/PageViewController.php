<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Page;
use App\Model\PagePhoto;

class PageViewController extends Controller
{
    public function show($link){
    	$pages=Page::where('status',1)->pluck('name','link');
    	$data=Page::where('link',$link)->first();

    	if($data==null){
    		return redirect()->back();
    	}
        $data['photo']=PagePhoto::where('fk_page_id',$data->id)->get();
        \Session::put('title_msg',$data->name);
        \Session::put('metaDescription',$data->title);
        return view('frontend.pages.show',compact('data','pages'));
    }
}
