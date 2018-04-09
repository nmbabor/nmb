<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\DivisionTown;
use Validator;


class DivisionTownController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allData=DivisionTown::orderBy('id','desc')->paginate(20);
        return view('backend.divisionTown.index',compact('allData'));
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
        $validator = Validator::make($request->all(), [
                    'name' => 'required',
                   
                ]);
                if ($validator->fails()) {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                }
        $nameWithSpace=str_replace('_',' ', $input['name']);
        $name=explode(',',$nameWithSpace);
        
        try{
            for ($i=0; $i < sizeof($name); $i++){
                $input['name']=$name[$i];
                 $link=str_replace(' , ', '-', $name[$i]);
                $link=str_replace(', ', '-', $link);
                $link=str_replace(' ,', '-', $link);
                $link=str_replace(',', '-', $link);
                $link=str_replace('/', '-', $link);
                $link=rtrim($link,' ');
                $link=str_replace(' ', '-', $link);
                $link=str_replace('.', '', $link);
                $link=substr($link,0,29);
                $link=strtolower($link);
                $input['link']=$link;
                DivisionTown::create($input);
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
            $data=DivisionTown::findOrFail($id);
            $input=$request->all();
            $link=str_replace(' , ', '-', $input['name']);
            $link=str_replace(', ', '-', $link);
            $link=str_replace(' ,', '-', $link);
            $link=str_replace(',', '-', $link);
            $link=str_replace('/', '-', $link);
            $link=rtrim($link,' ');
            $link=str_replace(' ', '-', $link);
            $link=str_replace('.', '', $link);
            $link=substr($link,0,29);
            $link=strtolower($link);
            $input['link']=$link;
         $validator = Validator::make($input, [
                    'name' => "required|unique:division_town,name,$id",
                    'link' => "required|unique:division_town,link,$id",
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->with('error','Duplicate or empty record found.');
                }
        
        try{
            $data->update($input);
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
        $data=DivisionTown::findOrFail($id);
        try{
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
