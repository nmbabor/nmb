<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\UserInfo;
use App\Model\UserCv;
use App\Model\CvEducation;
use App\Model\CvEmployment;
use App\Model\CvTraining;
use App\Model\CvLanguage;
use App\User;
use Auth;
use Validator;
use DB;

class UserCvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->type!=3){
            return redirect()->back();
        }
        $data=UserCv::where('created_by',Auth::user()->id)->first();
        if($data==null){
            return redirect('resume/create');
        }
       $employments=CvEmployment::where(['created_by'=>Auth::user()->id,'fk_cv_id'=>$data->id])->get();
       $educations=CvEducation::leftJoin('cv_education_level','cv_education.exam_title','cv_education_level.id')->select('cv_education.*','cv_education_level.level_name')->where(['created_by'=>Auth::user()->id,'fk_cv_id'=>$data->id])->get();
       $trainings=CvTraining::where(['created_by'=>Auth::user()->id,'fk_cv_id'=>$data->id])->get();
       $languages=CvLanguage::where(['created_by'=>Auth::user()->id,'fk_cv_id'=>$data->id])->get();
        \Session::put('title_msg','Resume');
        \Session::put('metaDescription','Create your Personal Resume for apply jobs');
        return view('frontend.auth.cv.show',compact('data','employments','educations','trainings','languages'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->type!=3){
            return redirect()->back();
        }
        $cv=UserCv::where('created_by',Auth::user()->id)->count();
        if($cv>0){
            return redirect('resume');
        }
        $profile=User::findOrFail(Auth::user()->id);
        $userInfo=UserInfo::where('fk_user_id',Auth::user()->id)->first();
        \Session::put('title_msg','Resume Create');
        \Session::put('metaDescription','Create your Personal Resume for apply jobs');
        return view('frontend.auth.cv.create',compact('profile','userInfo'));
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
       
        
        $validator = Validator::make($input, [
                    'name'             => 'required',
                    'profile_photo'    => 'required|image',
                    'email'            => 'required',
                    'present_address'  => 'required',
                    'permanent_address'=> 'required',
                    'date_of_birth'    => 'required',
                    'gender'           => 'required',
                    'religion'         => 'required',
                    'mobile'           => 'required',
                    'national_id'      => 'required',

                ]);
                if ($validator->fails()) {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                }
          $input['created_by']=Auth::user()->id;
          $input['date_of_birth']=date('Y-m-d',strtotime($input['date_of_birth']));
           $photos=UserCv::photoUpload($request);
            if(isset($photos['profile_photo'])){
                $input['profile_photo']=$photos['profile_photo'];
            }
        UserCv::create($input);
        try{
        $bug=0;
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
        }
         if($bug==0){
        return redirect('resume/edit')->with('success','Successfully Created');
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
        if(Auth::user()->type!=3){
            return redirect()->back();
        }
        $data=UserCv::where('created_by',Auth::user()->id)->first();
        if($data==null){
            return redirect()->back();
        }
        \Session::put('title_msg','Resume Update');
        \Session::put('metaDescription','Update your Personal Resume for apply jobs');
        return view('frontend.auth.cv.edit',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->type!=3){
            return redirect()->back();
        }
        $data=UserCv::where('created_by',Auth::user()->id)->first();
        if($data==null){
            return redirect()->back();
        }
        \Session::put('title_msg','Career Objective');
        \Session::put('metaDescription','Update your Career Objective in your Personal Resume for apply jobs');
        return view('frontend.auth.cv.objective',compact('data'));
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
        $input=$request->except('_token','_method');
        $validator = Validator::make($input, [
                    'name'             => 'required',
                    'profile_photo'    => 'image',
                    'email'            => 'required',
                    'present_address'  => 'required',
                    'permanent_address'=> 'required',
                    'date_of_birth'    => 'required',
                    'gender'           => 'required',
                    'religion'         => 'required',
                    'mobile'           => 'required',
                    'national_id'      => 'required',

                ]);
                if ($validator->fails()) {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                }
            $data=UserCv::findOrFail($id);
          $input['updated_by']=Auth::user()->id;
          $input['date_of_birth']=date('Y-m-d',strtotime($input['date_of_birth']));
           $photos=UserCv::photoUpload($request);
            if(isset($photos['profile_photo'])){
                $input['profile_photo']=$photos['profile_photo'];
                if(($data->profile_photo!=null) and file_exists("images/resume/$data->profile_photo")){
                        unlink("images/resume/$data->profile_photo");
                    }
            }
        try{
            $data->update($input);
        $bug=0;
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
        }
         if($bug==0){
        return redirect()->back()->with('success','Successfully Updated');
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
    public function updateObjective(Request $request, $id)
    {
        $input=$request->except('_token','_method');
        $validator = Validator::make($input, [
                    'career_objective' => 'required|max:250',
                    'special_qualification' => 'max:250',

                ]);
                if ($validator->fails()) {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                }
            $data=UserCv::findOrFail($id);
          $input['updated_by']=Auth::user()->id;
        try{
            $data->update($input);
        $bug=0;
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
        }
         if($bug==0){
        return redirect()->back()->with('success','Successfully Updated');
        }elseif($bug==1062){
            return redirect()->back()->with('error','The name has already been taken.');
        }else{
            return redirect()->back()->with('error','Something Error Found ! ');
        }
    }

    public function education(){
       if(Auth::user()->type!=3){
            return redirect()->back();
        }
        $cv=UserCv::where('created_by',Auth::user()->id)->first();
        if($cv==null){
            return redirect('resume');
        }
        $levels=DB::table('cv_education_level')->where('status',1)->pluck('level_name','id');
        $allData=CvEducation::leftJoin('cv_education_level','cv_education.exam_title','cv_education_level.id')->select('cv_education.*','cv_education_level.level_name')->where(['created_by'=>Auth::user()->id,'fk_cv_id'=>$cv->id])->get();
        \Session::put('title_msg','Academic Qualification update in resume');
        \Session::put('metaDescription','Update your Academic Qualification in your Personal Resume for apply jobs');
        return view('frontend.auth.cv.education',compact('allData','levels')); 
    }

    public function updateEducation(Request $request)
    {
        $input=$request->except('_token');
        $validator = Validator::make($input, [
                    'exam_title' => 'required',
                    'subject' => 'required|max:100',
                    'institute' => 'required|max:100',
                    'result' => 'required|max:20',
                    'pass_year' => 'required|max:10',
                    'duration' => 'required|max:10',

                ]);
                if ($validator->fails()) {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                }
            $cv=UserCv::where('created_by',Auth::user()->id)->first();
        try{
            if($input['form']=='update'){
                $id=$input['id'];
                $data=CvEducation::where(['created_by'=>Auth::user()->id,'fk_cv_id'=>$cv->id,'id'=>$id])->first();
                $data->update($input);
            }else{
                CvEducation::create([
                    'fk_cv_id'=>$cv->id,
                    'created_by'=>Auth::user()->id,
                    'exam_title'=>$input['exam_title'],
                    'subject'=>$input['subject'],
                    'institute'=>$input['institute'],
                    'result'=>$input['result'],
                    'pass_year'=>$input['pass_year'],
                    'duration'=>$input['duration']
                    ]);
            }
        $bug=0;
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
        }
         if($bug==0){
        return redirect()->back()->with('success','Successfully Updated');
        }elseif($bug==1062){
            return redirect()->back()->with('error','The name has already been taken.');
        }else{
            return redirect()->back()->with('error','Something Error Found ! ');
        }
    }
    public function employment(){
       if(Auth::user()->type!=3){
            return redirect()->back();
        }
        $cv=UserCv::where('created_by',Auth::user()->id)->first();
        if($cv==null){
            return redirect('resume');
        }
        $allData=CvEmployment::where(['created_by'=>Auth::user()->id,'fk_cv_id'=>$cv->id])->get();
        \Session::put('title_msg','Employment History update in resume');
        \Session::put('metaDescription','Update your Employment History in your Personal Resume for apply jobs');
        return view('frontend.auth.cv.employment',compact('allData')); 
    }

    public function updateEmployment(Request $request){
        $input=$request->except('_token');
        $validator = Validator::make($input, [
                    'organization'=>'required|max:50',
                    'location'=>'required|max:200',
                    'designation'=>'required|max:50',
                    'responsibilities'=>'required|max:200',
                    'experience'=>'required|max:10',


                ]);
                if ($validator->fails()) {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                }
            if(!isset($input['till_now'])){
                $input['till_now']=0;
            }
            $cv=UserCv::where('created_by',Auth::user()->id)->first();
        try{
            if($input['form']=='update'){
                $id=$input['id'];
                $data=CvEmployment::where(['created_by'=>Auth::user()->id,'fk_cv_id'=>$cv->id,'id'=>$id])->first();
                $data->update($input);
            }else{
                CvEmployment::create([
                    'fk_cv_id'=>$cv->id,
                    'created_by'=>Auth::user()->id,
                    'organization'=>$input['organization'],
                    'location'=>$input['location'],
                    'designation'=>$input['designation'],
                    'responsibilities'=>$input['responsibilities'],
                    'experience'=>$input['experience'],
                    'till_now'=>$input['till_now']
                    ]);
            }
        $bug=0;
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
        }
         if($bug==0){
        return redirect()->back()->with('success','Successfully Updated');
        }elseif($bug==1062){
            return redirect()->back()->with('error','The name has already been taken.');
        }else{
            return redirect()->back()->with('error','Something Error Found ! ');
        }
    }

 public function training(){
       if(Auth::user()->type!=3){
            return redirect()->back();
        }
        $cv=UserCv::where('created_by',Auth::user()->id)->first();
        if($cv==null){
            return redirect('resume');
        }
        $allData=CvTraining::where(['created_by'=>Auth::user()->id,'fk_cv_id'=>$cv->id])->get();
        \Session::put('title_msg','Training Professional  Summary update in resume');
        \Session::put('metaDescription','Update your Training Professional  Summary in your Personal Resume for apply jobs');
        return view('frontend.auth.cv.training',compact('allData')); 
    }

    public function updateTraining(Request $request){
        $input=$request->except('_token');
        $validator = Validator::make($input, [
                    'organization'=>'required|max:50',
                    'location'=>'required|max:200',
                    'course_title'=>'required|max:50',
                    'course_topic'=>'required|max:200',
                    'year'=>'required|max:10',


                ]);
                if ($validator->fails()) {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                }
            $cv=UserCv::where('created_by',Auth::user()->id)->first();
            if($input['form']=='update'){
                $id=$input['id'];
                $data=CvTraining::where(['created_by'=>Auth::user()->id,'fk_cv_id'=>$cv->id,'id'=>$id])->first();
                $data->update($input);
            }elseif($input['form']=='create'){
                CvTraining::create([
                    'fk_cv_id'=>$cv->id,
                    'created_by'=>Auth::user()->id,
                    'organization'=>$input['organization'],
                    'location'=>$input['location'],
                    'course_title'=>$input['course_title'],
                    'course_topic'=>$input['course_topic'],
                    'year'=>$input['year'],
                    'duration'=>$input['duration']
                    ]);
            }
        try{
        $bug=0;
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
        }
         if($bug==0){
        return redirect()->back()->with('success','Successfully Updated');
        }elseif($bug==1062){
            return redirect()->back()->with('error','The name has already been taken.');
        }else{
            return redirect()->back()->with('error','Something Error Found ! ');
        }
    }
 public function language(){
       if(Auth::user()->type!=3){
            return redirect()->back();
        }
        $cv=UserCv::where('created_by',Auth::user()->id)->first();
        if($cv==null){
            return redirect('resume');
        }
        $allData=CvLanguage::where(['created_by'=>Auth::user()->id,'fk_cv_id'=>$cv->id])->get();
        \Session::put('title_msg','Language Proficiency update in resume');
        \Session::put('metaDescription','Update your Language Proficiency in your Personal Resume for apply jobs');
        return view('frontend.auth.cv.language',compact('allData')); 
    }

    public function updateLanguage(Request $request){
        $input=$request->except('_token');
        $validator = Validator::make($input, [
                    'language_name'=>'required|max:10',
                    'reading'=>'required|max:10',
                    'writing'=>'required|max:10',
                    'speaking'=>'required|max:10',


                ]);
                if ($validator->fails()) {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                }
            $cv=UserCv::where('created_by',Auth::user()->id)->first();
            if($input['form']=='update'){
                $id=$input['id'];
                $data=CvLanguage::where(['created_by'=>Auth::user()->id,'fk_cv_id'=>$cv->id,'id'=>$id])->first();
                $data->update($input);
            }elseif($input['form']=='create'){
                CvLanguage::create([
                    'fk_cv_id'=>$cv->id,
                    'created_by'=>Auth::user()->id,
                    'language_name'=>$input['language_name'],
                    'reading'=>$input['reading'],
                    'writing'=>$input['writing'],
                    'speaking'=>$input['speaking']
                    ]);
            }
        try{
        $bug=0;
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
        }
         if($bug==0){
        return redirect()->back()->with('success','Successfully Updated');
        }elseif($bug==1062){
            return redirect()->back()->with('error','The name has already been taken.');
        }else{
            return redirect()->back()->with('error','Something Error Found ! ');
        }
    }


    public function delete(Request $request){
        $id=$request->id;
        $form=$request->form;



        try{
            if($form=='training'){
                CvTraining::where('id',$id)->delete();
            $bug=0;
            }elseif($form=='education'){
                CvEducation::where('id',$id)->delete();
            $bug=0;
            }elseif($form=='employment'){
                CvEmployment::where('id',$id)->delete();
            $bug=0;
            }elseif($form=='language'){
                CvLanguage::where('id',$id)->delete();
            $bug=0;
            }
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
        }
         if($bug==0){
            return redirect()->back()->with('success','Successfully Deleted!');
            }elseif($bug==1054){
                return redirect()->back()->with('error','This data is used anywhare.');
            }else{
                return redirect()->back()->with('error','Something Error Found ! ');
            }
    }

















}
