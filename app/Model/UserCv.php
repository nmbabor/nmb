<?php

namespace App\Model;
use Image;
use DB;
use Auth;

use Illuminate\Database\Eloquent\Model;

class UserCv extends Model
{
    protected $table='user_cv';
    protected $fillable=['name','email','status','fathers_name','mothers_name','present_address','permanent_address','date_of_birth','gender','religion','mobile','national_id','created_by','updated_by','profile_photo','career_objective','special_qualification'];
    static function photoUpload($request){
        $photos=array();
            if ($request->hasFile('profile_photo')) {
                $profile_photo=$request->file('profile_photo');
                $fileType=$profile_photo->getClientOriginalExtension();
                $fileName=rand(1,1000).date('dmyhis').".".$fileType;
                $path=base_path().'/images/resume/'.date('Y/m/d');
                if (!is_dir($path)) {
                    mkdir("$path",0777,true);
                    }
                $img = Image::make($profile_photo);
                $img->resize(180, 200);
                $img->save('images/resume/'.date('Y/m/d/').$fileName);
                $photos['profile_photo']=date('Y/m/d/').$fileName;
            }
            return $photos;
    }
}
