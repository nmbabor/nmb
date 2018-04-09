<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\PostField;
use App\Model\SubCategory;
use App\Model\Category;
use App\Model\SubCatWiseField;
use Validator;

class PostFieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filed=['text','number','dropdown'];
        foreach ($filed as $fieldType) {
           $type[$fieldType]=ucwords($fieldType);
        }
        $allData=PostField::orderBy('id','desc')->paginate(40);
        $category=Category::where('type',1)->where('status',1)->pluck('name','id');
        
        
        
        foreach ($allData as $key => $value) {
           $cat_name='';
           $catName=SubCatWiseField::leftJoin('sub_category','sub_category_wise_field.fk_sub_category_id','sub_category.id')->select('sub_category.sub_category_name')->where('fk_post_field_id',$value->id)->get();
           foreach ($catName as $catKey => $cat) {
            $cat_name=$cat_name.(($catKey>0)?', ':'').$cat->sub_category_name;
           }
          $allData[$key]['category']=$cat_name;
        }
        return view('backend.postField.index',compact('allData','category','type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.postField.loadValue');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
                    'title' => 'required',
                   
                ]);
                if ($validator->fails()) {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                }
        $input = $request->all();
        $input['created_by']=\Auth::user()->id;
        if($input['part_of']==null){
            unset($input['part_of']);
        }
        
        try{

        $field=PostField::create($input)->id;
        for ($j=0; $j <sizeof($input['sub_category_id']) ; $j++) { 
            SubCatWiseField::create([
                'fk_sub_category_id'=>$input['sub_category_id'][$j],
                'fk_post_field_id'=>$field
                ]);
        }
            
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
     * Category wise Sub category Load
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subCategory=SubCategory::where('fk_category_id',$id)->where('status',1)->pluck('sub_category_name','id');
        $partOf=SubCatWiseField::leftJoin('post_field','sub_category_wise_field.fk_post_field_id','post_field.id')->leftJoin('sub_category','sub_category_wise_field.fk_sub_category_id','sub_category.id')
            ->distinct()->where('sub_category.fk_category_id',$id)
            ->pluck('title','post_field.id');
        return view('backend.postField.loadSubCategory',compact('subCategory','partOf'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $filed=['text','number','dropdown'];
        foreach ($filed as $fieldType) {
           $type[$fieldType]=ucwords($fieldType);
        }
        $data=PostField::findOrFail($id);
        $categoryId=SubCatWiseField::leftJoin('sub_category','sub_category_wise_field.fk_sub_category_id','sub_category.id')->where('fk_post_field_id',$id)->value('fk_category_id');
        $partOf=SubCatWiseField::leftJoin('post_field','sub_category_wise_field.fk_post_field_id','post_field.id')->leftJoin('sub_category','sub_category_wise_field.fk_sub_category_id','sub_category.id')
            ->distinct()->where('post_field.id','!=',$id)->where('sub_category.fk_category_id',$categoryId)
            ->pluck('title','post_field.id');
        $subCategory=SubCategory::where('fk_category_id',$categoryId)->where('status',1)->pluck('sub_category_name','id');
        $existSubCat=SubCatWiseField::leftJoin('sub_category','sub_category_wise_field.fk_sub_category_id','sub_category.id')
            ->where('fk_post_field_id',$id)->pluck('fk_sub_category_id');
        $category=Category::where('type',1)->where('status',1)->pluck('name','id');
        return view('backend.postField.edit',compact('data','categoryId','existSubCat','subCategory','category','type','partOf'));
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
        $data=PostField::findOrFail($id);
         $validator = Validator::make($request->all(), [
                    'title' => 'required',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->with('error','Duplicate or empty record found.');
                }
        $input=$request->all();
        $input['updated_by']=\Auth::user()->id;
        if($input['part_of']==null){
            unset($input['part_of']);
        }
        $existSubCat=SubCatWiseField::leftJoin('sub_category','sub_category_wise_field.fk_sub_category_id','sub_category.id')
            ->where('fk_post_field_id',$id)->delete();
        try{
            for ($j=0; $j <sizeof($input['sub_category_id']) ; $j++) { 
                SubCatWiseField::create([
                    'fk_sub_category_id'=>$input['sub_category_id'][$j],
                    'fk_post_field_id'=>$id
                    ]);
            }
            $data->update($input);
            $bug=0;
        }catch(\Exception $e){
            $bug = $e->errorInfo[1]; 
        }
        if($bug==0){
        return redirect()->back()->with('success','Brand Successfully Updated');
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

            $data=PostField::findOrFail($id);
        try{
            SubCatWiseField::where('fk_post_field_id',$id)->delete();
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
