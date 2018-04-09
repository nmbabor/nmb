<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\AdPost;
use App\Model\Category;
use App\Model\SubCategory;
use App\Model\LastStepCategory;
use App\Model\SubCatWiseBrand;
use App\Model\SubCatWiseField;
use App\Model\DivisionTown;
use App\Model\Area;
use App\Model\PostFieldValue;
use App\Model\UserInfo;
use DB;
use Auth;
use URL;
use Validator;
use Image;

class ManageAdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adPost=AdPost::leftJoin('post_photo','ad_post.id','post_photo.fk_post_id')
                ->leftJoin('sub_category','ad_post.fk_sub_category_id','sub_category.id')
                ->leftJoin('category','sub_category.fk_category_id','category.id')
                ->leftJoin('users','ad_post.created_by','users.id')
                ->leftJoin('users as approved','ad_post.approved_by','approved.id')
                ->leftJoin('last_step_category','ad_post.fk_last_step_id','last_step_category.id')
                ->leftJoin('user_type','users.type','user_type.id')
                ->where('ad_post.is_approved','!=',1)
                ->where('ad_post.type','!=',3)
                ->select('ad_post.*','sub_category_name','last_step_category_name','post_photo.photo_one','category.name as cat_name','users.name as creator','approved.name as approver_name','user_type.type_name')
                ->orderBy('ad_post.id','DESC')
                ->paginate(20);
        return view('backend.ad.index',compact('adPost'));
    }
    public function published()
    {
        $adPost=AdPost::leftJoin('post_photo','ad_post.id','post_photo.fk_post_id')
                ->leftJoin('sub_category','ad_post.fk_sub_category_id','sub_category.id')
                ->leftJoin('category','sub_category.fk_category_id','category.id')
                ->leftJoin('users','ad_post.created_by','users.id')
                ->leftJoin('users as approved','ad_post.approved_by','approved.id')
                ->leftJoin('last_step_category','ad_post.fk_last_step_id','last_step_category.id')
                ->leftJoin('user_type','users.type','user_type.id')
                ->where('ad_post.is_approved',1)
                ->where('ad_post.type','!=',3)
                ->select('ad_post.*','sub_category_name','last_step_category_name','post_photo.photo_one','category.name as cat_name','users.name as creator','approved.name as approver_name','user_type.type_name')
                ->orderBy('ad_post.id','DESC')
                ->paginate(20);
        return view('backend.ad.index',compact('adPost'));
    }
public function jobs()
    {
        $adPost=AdPost::leftJoin('post_photo','ad_post.id','post_photo.fk_post_id')
                ->leftJoin('sub_category','ad_post.fk_sub_category_id','sub_category.id')
                ->leftJoin('category','sub_category.fk_category_id','category.id')
                ->leftJoin('users','ad_post.created_by','users.id')
                ->leftJoin('users as approved','ad_post.approved_by','approved.id')
                ->leftJoin('last_step_category','ad_post.fk_last_step_id','last_step_category.id')
                ->leftJoin('user_type','users.type','user_type.id')
                ->where('ad_post.is_approved','!=',1)
                ->where('ad_post.type',3)
                ->select('ad_post.*','sub_category_name','last_step_category_name','post_photo.photo_one','category.name as cat_name','users.name as creator','approved.name as approver_name','user_type.type_name')
                ->orderBy('ad_post.id','DESC')
                ->paginate(20);
        return view('backend.ad.index',compact('adPost'));
    }
    public function publishedJobs()
    {
        $adPost=AdPost::leftJoin('post_photo','ad_post.id','post_photo.fk_post_id')
                ->leftJoin('sub_category','ad_post.fk_sub_category_id','sub_category.id')
                ->leftJoin('category','sub_category.fk_category_id','category.id')
                ->leftJoin('users','ad_post.created_by','users.id')
                ->leftJoin('users as approved','ad_post.approved_by','approved.id')
                ->leftJoin('last_step_category','ad_post.fk_last_step_id','last_step_category.id')
                ->leftJoin('user_type','users.type','user_type.id')
                ->where('ad_post.is_approved',1)
                ->where('ad_post.type',3)
                ->select('ad_post.*','sub_category_name','last_step_category_name','post_photo.photo_one','category.name as cat_name','users.name as creator','approved.name as approver_name','user_type.type_name')
                ->orderBy('ad_post.id','DESC')
                ->paginate(20);
        return view('backend.ad.index',compact('adPost'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
            $adPost= AdPost::where('id',$request->id)->update([
                'is_approved'=>$request->is_approved,
                'approved_by'=>Auth::user()->id,
                ]);
        try{   
            $bug=0;
            }catch(\Exception $e){
                $bug=$e->errorInfo[1];
            }
             if($bug==0){
            return redirect('manage-ad')->with('success','Successfully Updated');
            }else{
                return redirect()->back()->with('error','Something Error Found ! ');
            }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=AdPost::leftJoin('post_photo','ad_post.id','post_photo.fk_post_id')
                ->leftJoin('brands','ad_post.fk_brand_id','brands.id')
                ->leftJoin('division_town','ad_post.fk_division_id','division_town.id')
                ->leftJoin('area','ad_post.fk_area_id','area.id')
                ->leftJoin('sub_category','ad_post.fk_sub_category_id','sub_category.id')
                ->leftJoin('category','sub_category.fk_category_id','category.id')
                ->leftJoin('last_step_category','ad_post.fk_last_step_id','last_step_category.id')
                ->leftJoin('users','ad_post.created_by','users.id')
                ->leftJoin('users as update','ad_post.updated_by','update.id')
                ->select('ad_post.*','brands.brand_name','division_town.name as division_name','area.area_name','sub_category_name','last_step_category_name','users.name as creator','update.name as updator','category.name as cat_name','post_photo.photo_one','post_photo.photo_two','post_photo.photo_three','post_photo.photo_four')
                ->where('ad_post.status',1)
                ->where('ad_post.id',$id)
                ->orderBy('ad_post.id','DESC')
                ->first();
            if($data==null){
                return redirect()->back();
            }

        $mobiles=DB::table('post_wise_number')->where('fk_post_id',$id)->get();
        $postField=PostFieldValue::leftJoin('post_field','post_field_value.fk_post_field_id','post_field.id')->select('post_field_value.field_value','fk_post_field_id','post_field.title')->where('fk_post_id',$id)->where('part_of',null)->get();

        $fieldPart=PostFieldValue::leftJoin('post_field','post_field_value.fk_post_field_id','post_field.id')->leftJoin('post_field as post_field2','post_field.part_of','post_field2.id')->select('post_field_value.field_value','post_field.title','post_field.id','post_field.part_of','post_field2.id as id2','post_field2.title as title2')->where('fk_post_id',$id)->where('post_field.part_of','!=',null)->orderBy('post_field.id','DESC')->get();
        $fieldParts=json_decode($fieldPart);
        $extraPart=array();
        foreach($fieldParts as $key => $value){
            foreach ($fieldParts as $value2) {
                if($value->id==$value2->part_of){

                $extraPart[]=array(
                    'id'=>$value->id,
                    'id2'=>$value->id2,
                    'title'=>$value->title,
                    'title2'=>$value->title2,
                    'field_value'=>$value->field_value,
                    'field_value2'=>$value2->field_value,
                    );
                }
                
            }
        }
        foreach($extraPart as $key => $value){
            foreach ($extraPart as $value2) {
                if($value['title']==$value2['title2']){
                    unset($extraPart[$key]);

                }
                
            }
        }
        if($data->fk_last_step_id!=null){
            $category=LastStepCategory::leftJoin('sub_category','last_step_category.fk_sub_category_id','sub_category.id')->leftJoin('category','sub_category.fk_category_id','category.id')->where('last_step_category.id',$data->fk_last_step_id)->select('sub_category.id as sub_id','last_step_category.id as last_id','sub_category.sub_category_name','last_step_category.last_step_category_name','category.name')->first();
        }else
            {
            $category=SubCategory::leftJoin('category','sub_category.fk_category_id','category.id')->where('sub_category.id',$data->fk_sub_category_id)->select('sub_category.id as sub_id','sub_category.sub_category_name','category.name')->first();
        }
        $division=DivisionTown::where('status',1)->where('type',1)->pluck('name','id')->toArray();
        $town=DivisionTown::where('status',1)->where('type',2)->pluck('name','id')->toArray();
        $division_town=array(
            'Town'=>$town,
            'Division'=>$division,
            );
        $area=Area::where('status',1)->where('fk_division_id',$data->fk_division_id)->pluck('area_name','id');
        $brand=SubCatWiseBrand::leftJoin('brands','sub_category_wise_brand.fk_brand_id','brands.id')->where('fk_sub_category_id',$category->sub_id)->pluck('brand_name','brands.id');
        $fields=SubCatWiseField::leftJoin('post_field','sub_category_wise_field.fk_post_field_id','post_field.id')->where('fk_sub_category_id',$category->sub_id)->select('title','post_field.id','required','type','value','part_of')->where('post_field.status',1)->where('post_field.part_of','=',null)->get();
        $part=SubCatWiseField::leftJoin('post_field','sub_category_wise_field.fk_post_field_id','post_field.id')->leftJoin('post_field as post_field2','post_field.part_of','post_field2.id')->where('fk_sub_category_id',$category->sub_id)->select('post_field.id','post_field.title','post_field.required','post_field.type','post_field.value','post_field.part_of','post_field2.id as id2','post_field2.title as title2','post_field2.required as required2','post_field2.type as type2','post_field2.value as value2','post_field2.part_of as part_of2')->where('post_field2.status',1)->where('post_field.part_of','!=',null)->distinct()->get();
        $parts=json_decode($part);
        foreach($parts as $key => $value){
            foreach ($parts as $value2) {
                if($value->id==$value2->part_of){
                    unset($parts[$key]);
                }
                
            }
        }
        $numbers=DB::table('mobile_number')->where('fk_user_id',$data->created_by)->where('is_verified',1)->get();
        $userInfo=UserInfo::leftJoin('users','user_info.fk_user_id','users.id')->select('name','email','mobile','mobile_verified','email_verified','fk_division_id','fk_area_id','address')->where('fk_user_id',$data->created_by)->first();
        return view('backend.ad.edit',compact('data','mobiles','postField','extraPart','division_town','category','brand','fields','parts','numbers','area','userInfo'));
  
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
        date_default_timezone_set('Asia/Dhaka');
        $data=AdPost::findOrFail($id);
        if(count($data)==0){
            return redirect()->back();
        }
        $input=$request->all();

        $validator = Validator::make($request->all(), [
                    'type'          => 'required|numeric',
                    'title'         => 'required|max:250',
                    'condition'     => 'required|numeric',
                    'mobile_number' => 'required',
                    'photo_one'     => 'image',
                    'photo_two'     => 'image',
                    'photo_three'   => 'image',
                    'photo_four'    => 'image'
                ]);
        
                if ($validator->fails()) {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                }
            if(!isset($input['is_negotiable'])){
                $input['is_negotiable']=2;
            }
            

            /*return $input;*/
            
        try{
             $photos=AdPost::photoUpdate($request,$id);
            DB::table('post_wise_number')->where('fk_post_id',$id)->delete();
            for ($i=0; $i <sizeof($input['mobile_number']) ; $i++) { 
                DB::table('post_wise_number')->insert([
                    'mobile_number'=>$input['mobile_number'][$i],
                    'fk_post_id'=>$id,
                    ]);
            }
            if(isset($input['fk_post_field_id'])){

                for ($j=0; $j <sizeof($input['fk_post_field_id']) ; $j++) {
                    $fieldId=$input['fk_post_field_id'][$j];
                    PostFieldValue::where('fk_post_id',$id)->where('fk_post_field_id',$fieldId)->update([
                        'field_value'=>$input['field_value'][$j],
                        ]);
                }
            }
            $data->update($input);   
            $bug=0;
            }catch(\Exception $e){
                $bug=$e->errorInfo[1];
            }
             if($bug==0){
            return redirect()->back()->with('success','Data Successfully Updated');
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
        $data=AdPost::where('id',$id)->first();
        if($data==null){
            return redirect()->back();
        }
        
        $photos=AdPost::deletePhoto($id);
        DB::table('post_wise_number')->where('fk_post_id',$id)->delete();
        PostFieldValue::where('fk_post_id',$id)->delete();
            $data->delete();
        try{
            $bug=0;
            $error=0;
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
            $error=$e->errorInfo[2];
        }
        if($bug==0){
            return redirect()->back()->with('success','Ad Successfully Deleted!');
        }elseif($bug==1451){
            return redirect()->back()->with('error','This ad is Used anywhere ! ');
        }
        elseif($bug>0){
            return redirect()->back()->with('error','Some thing error found !');

        } 
    }
}
