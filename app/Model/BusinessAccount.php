<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Image;
use DB;
use Auth;
class BusinessAccount extends Model
{
    protected $table='business_account';
    protected $fillable=['title','status','location','website','description','open_hour','closed_day','cover_photo','profile_photo','link','is_approved','approved_by','services','contact_email','contact_phone','fk_user_id','fk_sub_category_id'];

	static function photoUpload($request){
        $photos=array();
        if ($request->hasFile('cover_photo')) {
                $cover_photo=$request->file('cover_photo');
                $fileType=$cover_photo->getClientOriginalExtension();
                $fileName=rand(1,1000).date('dmyhis').".".$fileType;
                $path=base_path().'/images/business/cover/'.date('Y/m/d');
                if (!is_dir($path)) {
                    mkdir("$path",0777,true);
                    }
                $img = Image::make($cover_photo);
                $img->resize(800, 350);
                $img->save('images/business/cover/'.date('Y/m/d/').$fileName);
                $photos['cover_photo']=date('Y/m/d/').$fileName;
            }
            if ($request->hasFile('profile_photo')) {
                $profile_photo=$request->file('profile_photo');
                $fileType=$profile_photo->getClientOriginalExtension();
                $fileName=rand(1,1000).date('dmyhis').".".$fileType;
                $path=base_path().'/images/business/profile/'.date('Y/m/d');
                if (!is_dir($path)) {
                    mkdir("$path",0777,true);
                    }
                $img = Image::make($profile_photo);
                $img->resize(200, 150);
                $img->save('images/business/profile/'.date('Y/m/d/').$fileName);
                $photos['profile_photo']=date('Y/m/d/').$fileName;
            }
            return $photos;
    }
    static function photoUpdate($request){
        $data=DB::table('business_account')->where('fk_user_id',Auth::user()->id)->first();
        $photos=array();
        if ($request->hasFile('cover_photo')) {
                $path=base_path().'/images/business/cover/'.date('Y/m/d');
                if (!is_dir($path)) {
                    mkdir("$path",0777,true);
                    }
                $cover_photo=$request->file('cover_photo');
                $fileType=$cover_photo->getClientOriginalExtension();
                $fileName=rand(1,1000).date('dmyhis').".".$fileType;
                /*$fileName=$cover_photo->getClientOriginalName();*/
                $img = Image::make($cover_photo);
                $img->resize(800, 350);
                $img->save('images/business/cover/'.date('Y/m/d/').$fileName);
                $photos['cover_photo']=date('Y/m/d/').$fileName;
                /*Delete old photo*/
                $img_path1='images/business/cover/'.$data->cover_photo;

                if($data->cover_photo!=null){
                    if(file_exists($img_path1)){
                        unlink($img_path1);
                    }
                }
            }
            if ($request->hasFile('profile_photo')) {
                $profile_photo=$request->file('profile_photo');
                $fileType=$profile_photo->getClientOriginalExtension();
                $fileName=rand(1,1000).date('dmyhis').".".$fileType;
                $path=base_path().'/images/business/profile/'.date('Y/m/d');
                if (!is_dir($path)) {
                    mkdir("$path",0777,true);
                    }
                $img = Image::make($profile_photo);
                 $img->resize(200, 150);
                $img->save('images/business/profile/'.date('Y/m/d/').$fileName);
                $photos['profile_photo']=date('Y/m/d/').$fileName;
                /*Delete old photo*/
                $img_path2='images/business/profile/'.$data->profile_photo;

                if($data->profile_photo!=null){
                    if(file_exists($img_path2)){
                        unlink($img_path2);
                    }
                }
            }
            return $photos;
    }









 }