<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Eshop;
use App\Model\UserInfo;
use Auth;
use Validator;

class EshopManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eshop=Eshop::leftJoin('users','eshop_list.fk_user_id','users.id')->leftJoin('users as approve','eshop_list.approved_by','approve.id')->select('users.name','users.email','users.mobile','approve.name as approver_name','eshop_list.*')->orderBy('eshop_list.id','DESC')->paginate(20);
    
        return view('backend.eshop.index',compact('eshop'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data=Eshop::findOrFail($request->id);
        try{
            $data->update([
                'is_approved'=>$request->is_approved,
                ]);
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

   /* $host="127.0.0.1"; 
    $user='root';
    $pass='';
    $db='combdebu_'.$request->db_name; */

        try {
            /*$dbh = new \PDO("mysql:host=$host", $user, $pass);
            if($dbh->exec("CREATE DATABASE `$db`;")){
                $error='Database created successfully';
            }else{
               $error=($dbh->errorInfo()[2]);
                
            }*/
            $data=Eshop::findOrFail($request->id);
            $data->update([
                'db_name'=>$request->db_name,
                'is_approved'=>1,
                'approved_by'=>Auth::user()->id,
                ]);
            $bug=0;

        } catch (PDOException $e) {
            //die("DB ERROR: ". $e->getMessage());
            $bug=$e->errorInfo[1];
            $bug1=$e->getMessage();
        }
        if($bug==0){
        return redirect()->back()->with('success','Successfully Approved.');
        }else{
            return redirect()->back()->with('error','Error: '.$bug1);
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
        $data=Eshop::leftJoin('users','eshop_list.fk_user_id','users.id')->leftJoin('users as approve','eshop_list.approved_by','approve.id')->select('users.name','users.email','users.mobile','approve.name as approver_name','eshop_list.*')->where('eshop_list.id',$id)->orderBy('eshop_list.id','DESC')->first();
    
        return view('backend.eshop.edit',compact('data'));
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
                    'db_name' => ['required',"unique:eshop_list,db_name,$id",'max:20'],
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
