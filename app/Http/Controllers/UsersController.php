<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Validator;
use Hash;
use Auth;
use DB;
class UsersController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of Admin.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function index(Request $request)
    {
        $allUsers=User::orderBy('id','DESC')->paginate(10);
        //return $allUsers;
        return view('backend.user.index',compact('allUsers'));
    }

    /**
     * Show the form for creating a new Admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type=DB::table('user_type')->pluck('type_name','type');
        return view('backend.user.create',compact('type'));
    }

    /**
     * Store a newly created Admin in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $validator = Validator::make($request->all(), [
                    'name' => 'required|max:20',
                    'email' => 'email|required|unique:users',
                    'password' => 'required|min:6|confirmed',
                    /*enable   extension=php_fileinfo*/ 
                ]);
                if ($validator->fails()) {
                    return redirect('users/create')
                        ->withErrors($validator)
                        ->withInput();
                }
                
            $input = $request->all();
            $input['password']=bcrypt($input['password']);
            //return $input;
           $insert= User::create($input);
            try{

            $bug=0;
            }catch(\Exception $e){
                $bug=$e->errorInfo[1];
            }
             if($bug==0){
            return redirect('users')->with('success','Data Successfully Inserted');
            }elseif($bug==1062){
                return redirect('users')->with('error','The Email has already been taken.');
            }else{
                return redirect('users')->with('error','Something Error Found ! ');
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
        $data=User::findOrFail($id);
        $type=DB::table('user_type')->pluck('type_name','type');
        return view('backend.user.show',compact('data','type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=User::findOrFail($id);
        return view('backend.user.password',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //return $request->all();
        $data=User::findOrFail($request->id);
        
        $validator = Validator::make($request->all(), [
                    'name'          => 'required|max:50',
                    'email'         => 'email|required'
                ]);
        
                if ($validator->fails()) {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                }

        $input=$request->all();
            /*return $input;*/
            try{
                $data->update($input);
                $result=0;
            }catch(\Exception $e){
                $result = $e->errorInfo[1];
            }

        if($result==0){
        return redirect()->back()->with('success','Profile Successfully Updated');
        }elseif($result==1062){
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
       $data=User::findOrFail($id);
       try{
            $data->delete();
            $bug=0;
            $error=0;
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
            $error=$e->errorInfo[2];
        }
        if($bug==0){
       return redirect('users')->with('success','Data has been Successfully Deleted!');
        }elseif($bug==1451){
       return redirect('users')->with('error','This Data is Used anywhere ! ');

        }
        elseif($bug>0){
       return redirect('users')->with('error','Some thing error found !');

        }
    }

    public function password(Request $request){
        $input=$request->all();
        $newPass=$input['password'];
        $data=User::findOrFail($request->id);
        if(!empty($input['old_password'])){
            $inputOld=$input['old_password'];
            if(Hash::check($inputOld,$data['password'])){
                $validator = Validator::make($request->all(),[
                    'password' => 'required|min:6|confirmed',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                }
                $input['password']=bcrypt($newPass);

            }else{
                return redirect()->back()->with('errorPass','Old Password not match !');
            }

        }
        try{
            $data->update($input);
            $bug=0;
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
        }
        if($bug==0){
            return redirect()->back()->with('success','Password Changed Successfully !');
        }else{
            return redirect()->back()->with('error','Something is wrong !');

        }
    }
    public function profile(){
        $id=Auth::user()->id;
        $data=User::findOrFail($id);
        $type=DB::table('user_type')->where('type',Auth::user()->type)->pluck('type_name','type');
        return view('backend.profile.show',compact('data','type'));
    }

    public function changePass()
    {
        $id=Auth::user()->id;
        $data=User::findOrFail($id);
        return view('backend.profile.password',compact('data'));
    }
        















}