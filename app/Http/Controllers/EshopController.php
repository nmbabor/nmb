<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Eshop;
use App\Model\UserInfo;
use Auth;
use Validator;


class EshopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->type!=5){
            return redirect()->back();
        }
        $data=Eshop::leftJoin('users','eshop_list.fk_user_id','users.id')->select('eshop_list.*','users.name')->where('fk_user_id',Auth::user()->id)->first();
        if($data==null){
            return redirect('eshop/create');
        }else{
            
            return redirect('eshop/edit');
        }
    
        return view('frontend.auth.eshop.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $eshop=Eshop::where('fk_user_id',Auth::user()->id)->count();
        if($eshop>0){
            return redirect('eshop');
        }
        $userInfo=UserInfo::where('fk_user_id',Auth::user()->id)->first();
        return view('frontend.auth.eshop.create',compact('userInfo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->except('_token'), [
                    'eshop_name' => 'required',
                    'title' => 'required',
                    'location' => 'required',
                    'description' => 'required',
                    'subdomain' => ['required','unique:eshop_list','max:20'],
                ]);
                if ($validator->fails()) {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                }
                $input= $request->except('_token');
                $input['fk_user_id']=Auth::user()->id;
                $input['db_name']='combdebu_'.$input['subdomain'];
            Eshop::create($input);
        try{
        $bug=0;
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
        }
         if($bug==0){
        return redirect('eshop/edit')->with('success','Successfully submitted your request.');
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
        if(Auth::user()->type!=5){
            return redirect()->back();
        }
        $data=Eshop::leftJoin('users','eshop_list.fk_user_id','users.id')->select('eshop_list.*','users.name')->where('fk_user_id',Auth::user()->id)->first();
        if($data==null){
            return redirect('eshop/create');
        }
    
        return view('frontend.auth.eshop.edit',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $validator = Validator::make($request->except('_token'), [
                    'eshop_name' => 'required',
                    'title' => 'required',
                    'location' => 'required',
                    'description' => 'required',
                    'subdomain' => ['required',"unique:eshop_list,subdomain,$id",'max:20'],
                ]);
                if ($validator->fails()) {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                }
                $input= $request->except('_token');

            $data=Eshop::findOrFail($id);
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
}
