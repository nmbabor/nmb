<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\BusinessAccount;
use App\Model\SubCategory;
use App\Model\Category;
use Validator;
use Auth;
use App\User;

class ManageBusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $business=BusinessAccount::leftJoin('users','business_account.fk_user_id','users.id')->leftJoin('users as approve','business_account.approved_by','approve.id')->where('business_account.is_approved',1)->select('users.name','users.email','users.mobile','approve.name as approver_name','business_account.*')->orderBy('business_account.id','DESC')->paginate(20);
        return view('backend.business.index',compact('business'));
    }
    public function pending()
    {   
        $business=BusinessAccount::leftJoin('users','business_account.fk_user_id','users.id')->leftJoin('users as approve','business_account.approved_by','approve.id')
            ->where('business_account.is_approved','!=',1)
            ->select('users.name','users.email','users.mobile','approve.name as approver_name','business_account.*')->orderBy('business_account.id','DESC')->paginate(20);
        return view('backend.business.index',compact('business'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $adPost= BusinessAccount::where('id',$request->id)->update([
                'is_approved'=>$request->is_approved,
                'approved_by'=>Auth::user()->id,
                ]);
        try{   
            $bug=0;
            }catch(\Exception $e){
                $bug=$e->errorInfo[1];
            }
             if($bug==0){
            return redirect('manage-business')->with('success','Successfully Updated');
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
        $data=BusinessAccount::leftJoin('users','business_account.fk_user_id','users.id')->leftJoin('sub_category','business_account.fk_sub_category_id','sub_category.id')->select('business_account.*','users.name','users.email','users.mobile','sub_category_name','fk_category_id')->where('business_account.id',$id)->first();
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
        return view('backend.business.edit',compact('days','category','data','subCat','hour'));
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
        $data=BusinessAccount::findOrFail($id);
        $link=str_replace(' , ', '-', $input['link']);
        $link=str_replace(', ', '-', $link);
        $link=str_replace(' ,', '-', $link);
        $link=str_replace(',', '-', $link);
        $link=str_replace('/', '-', $link);
        $link=rtrim($link,' ');
        $link=str_replace(' ', '-', $link);
        $link=str_replace('.', '', $link);
        
        $input['link']=strtolower($link);
      
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
            User::where('id',$data->fk_user_id)->update(['name'=>$input['name']]);
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
}
