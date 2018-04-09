<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Http\Requests;
use App\Model\Category;
use Validator;

class CategoryController extends Controller
{
     public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    public function index(Request $request)
    {  
        $url=$request->path();
        $type=($url=='category')?'1':'2';
        $max_serial=Category::where('type',$type)->max('serial_num'); 
        $allData=Category::where('type',$type)->orderBy('id','desc')->paginate(10);
        return view('backend.category.index',compact('allData','max_serial','type','url'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $link=str_replace(' , ', '-', $input['name']);
        $link=str_replace(', ', '-', $link);
        $link=str_replace(' ,', '-', $link);
        $link=str_replace(',', '-', $link);
        $link=str_replace('/', '-', $link);
        $link=rtrim($link,' ');
        $link=str_replace(' ', '-', $link);
        $link=str_replace('.', '', $link);
        $link=substr($link,0,40);
        $link=strtolower($link);
        $input['link']=$link;
        if($input['type']==2){
            $input['link']=$link.'2';
        }
        $validator = Validator::make($input, [
                    'name' => 'required',
                    'link' => 'required|unique:category',
                   
                ]);
                if ($validator->fails()) {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                }
        $input['created_by']=\Auth::user()->id;
        if ($request->hasFile('icon_photo')) {
            $photo=$request->file('icon_photo');
            $fileType=$photo->getClientOriginalExtension();
            $fileName=rand(1,1000).date('dmyhis').".".$fileType;
            $img=\Image::make($photo);
            $img->resize(50,40);
            $img->save('public/img/category/'.$input['type'].'/'.$fileName);
            $input['icon_photo']=$fileName;
        }
        Category::create($input);
        try{
        $bug=0;
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
        }
         if($bug==0){
        return redirect()->back()->with('success','Category Successfully Inserted');
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
        $allData=Category::orderBy('id','desc')->paginate(10);
        return view('backend.category.memberCategory',compact('allData'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=Category::findOrFail($id);
        $max_serial=Category::where('type',$data->type)->max('serial_num');
        $url=\Request::path();
        $url=explode('/',$url);
        $url= $url[0];
        return view('backend.category.edit',compact('data','max_serial','url'));
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
        $input = $request->all();
        $link=str_replace(' , ', '-', $input['name']);
        $link=str_replace(', ', '-', $link);
        $link=str_replace(' ,', '-', $link);
        $link=str_replace(',', '-', $link);
        $link=str_replace('/', '-', $link);
        $link=rtrim($link,' ');
        $link=str_replace(' ', '-', $link);
        $link=str_replace('.', '', $link);
        $link=substr($link,0,40);
        $link=strtolower($link);
        $input['link']=$link;
        if($input['type']==2){
            $input['link']='b-'.$link;
        }
        $data=Category::findOrFail($id);
         $validator = Validator::make($input, [
                    'name' => 'required',
                    'serial_num' => 'required',
                    'link' => "required|unique:category,link,$id",
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->with('error','Duplicate or empty record found.');
                }
        $input['updated_by']=\Auth::user()->id;
        if ($request->hasFile('icon_photo')) {
            $photo=$request->file('icon_photo');
            $fileType=$photo->getClientOriginalExtension();
            $fileName=rand(1,1000).date('dmyhis').".".$fileType;
            $img=\Image::make($photo);
            $img->resize(50,40);
            $img->save('public/img/category/'.$input['type'].'/'.$fileName);
            $input['icon_photo']=$fileName;
            $img_path='public/img/category/'.$input['type'].'/'.$data['icon_photo'];

            if($data['icon_photo']!=null and file_exists($img_path)){
            unlink($img_path);
            }
        }
        
        try{
            $data->update($input);
            $bug=0;
        }catch(\Exception $e){
            $bug = $e->errorInfo[1]; 
        }
        if($bug==0){
        return redirect()->back()->with('success','Category Successfully Updated');
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

            $data=Category::findOrFail($id);
        try{
            $img_path='public/img/category/'.$data->type.'/'.$data->icon_photo;
            if($data->icon_photo!=null and file_exists($img_path)){
            unlink($img_path);
            }
            $data->delete();
            $bug=0;
            $error=0;
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
            $error=$e->errorInfo[2];
        }
        if($bug==0){
       return redirect()->back()->with('success','Data has been Successfully Deleted!');
        }elseif($bug==1451){
       return redirect()->back()->with('error','This Data is Used anywhere ! ');

        }
        elseif($bug>0){
       return redirect()->back()->with('error','Some thing error found !');

        }
    }
}