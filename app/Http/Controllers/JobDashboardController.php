<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\AdPost;
use App\Model\BusinessAccount;
use App\Model\UserCv;
use App\Model\CvEducation;
use App\Model\CvEmployment;
use App\Model\CvTraining;
use App\Model\CvLanguage;
use App\Model\JobApplication;
use Auth;
use DB;

class JobDashboardController extends Controller
{
    public function index(){
        $adPost=AdPost::leftJoin('post_photo','ad_post.id','post_photo.fk_post_id')
        		->leftJoin('sub_category','ad_post.fk_sub_category_id','sub_category.id')
        		->leftJoin('category','sub_category.fk_category_id','category.id')
        		->leftJoin('last_step_category','ad_post.fk_last_step_id','last_step_category.id')
        		->select('ad_post.*','sub_category_name','last_step_category_name','post_photo.photo_one','category.name as cat_name')
        		->where('ad_post.created_by',Auth::user()->id)
        		->where('ad_post.status',1)
        		->where('ad_post.type',3)
        		->orderBy('ad_post.id','DESC')
        		->get();
            $business=BusinessAccount::where('fk_user_id',Auth::user()->id)->first();
    	return view('frontend.auth.jobs.index',compact('adPost','business'));
    }

    public function applicants(Request $request,$status,$link){
    	$ad=AdPost::leftJoin('post_photo','ad_post.id','post_photo.fk_post_id')
        		->leftJoin('sub_category','ad_post.fk_sub_category_id','sub_category.id')
        		->leftJoin('category','sub_category.fk_category_id','category.id')
        		->leftJoin('last_step_category','ad_post.fk_last_step_id','last_step_category.id')
        		->select('ad_post.*','sub_category_name','last_step_category_name','post_photo.photo_one','category.name as cat_name')
        		->where('ad_post.created_by',Auth::user()->id)
        		->where('ad_post.link',$link)
        		->first();
        if($ad==null){
        	return redirect()->back();
        }
        $total=JobApplication::select(DB::raw('count(id) as total'),'status')->groupBy('status')->where('fk_post_id',$ad->id)->get();
        $applicants=JobApplication::leftJoin('users','job_application.fk_user_id','users.id')->leftJoin('cv_employment','job_application.fk_user_id','cv_employment.created_by')->select('users.name','fk_user_id','job_application.id','job_application.status','job_application.status',DB::raw('SUM(cv_employment.experience) as experience'))->groupBy('fk_user_id')->where('fk_post_id',$ad->id);
        if($status=='all'){

             $applicants = $applicants->get();
        }else{
            
             $applicants = $applicants->where('job_application.status',$status)->get();
        }
        
        if(isset($request->id)){
        	$id=$request->id;
	       $data=UserCv::where('created_by',$id)->first();
	       if($data==null){
	       	return redirect()->back();
	       }
	       $educations=CvEducation::leftJoin('cv_education_level','cv_education.exam_title','cv_education_level.id')->select('cv_education.*','cv_education_level.level_name')->where(['created_by'=>$id,'fk_cv_id'=>$data->id])->get();
	       $employments=CvEmployment::where(['created_by'=>$id,'fk_cv_id'=>$data->id])->get();
	       $trainings=CvTraining::where(['created_by'=>$id,'fk_cv_id'=>$data->id])->get();
	       $languages=CvLanguage::where(['created_by'=>$id,'fk_cv_id'=>$data->id])->get();
        }
    	return view('frontend.auth.jobs.applicants',compact('ad','applicants','data','employments','educations','trainings','languages','id','link','status','total'));
    }

    public function loadCv($id,$post){
       $data=UserCv::where('created_by',$id)->first();
       $employments=CvEmployment::where(['created_by'=>$id,'fk_cv_id'=>$data->id])->get();
       $educations=CvEducation::leftJoin('cv_education_level','cv_education.exam_title','cv_education_level.id')->select('cv_education.*','cv_education_level.level_name')->where(['created_by'=>$id,'fk_cv_id'=>$data->id])->get();
       $trainings=CvTraining::where(['created_by'=>$id,'fk_cv_id'=>$data->id])->get();
       $languages=CvLanguage::where(['created_by'=>$id,'fk_cv_id'=>$data->id])->get();

    	$applicants=JobApplication::where(['fk_user_id'=>$id,'fk_post_id'=>$post])->first();
    	if($applicants->status==0){
    		$applicants->update(['status'=>3]);
    	}
       return view('frontend.auth.jobs.loadCv',compact('data','employments','educations','trainings','languages'));
    }

public function status(Request $request){
	$input=$request->except('_token');
	for ($i=0; $i <sizeof($input['id']) ; $i++) { 
		$id=$input['id'];
		$status=$input['status'];
		JobApplication::where('id',$id)->update(['status'=>$status]);
		return redirect()->back();
	}
}




}
