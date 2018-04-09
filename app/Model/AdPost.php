<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Image;
use DB;

class AdPost extends Model
{
    protected $table='ad_post';
    protected $fillable=['title','type','condition','price','is_negotiable','tag','description','is_approved','approved_by','fk_sub_category_id','fk_last_step_id','created_by','updated_by','status','address','fk_division_id','fk_brand_id','fk_area_id','visitor','link','price2'];

    static function approvedAd(){
        $adPost=DB::table('ad_post')
                    ->leftJoin('post_photo','ad_post.id','post_photo.fk_post_id')
                    ->leftJoin('users','ad_post.created_by','users.id')
                    ->leftJoin('division_town','ad_post.fk_division_id','division_town.id')
                    ->leftJoin('area','ad_post.fk_area_id','area.id')
                    ->leftJoin('sub_category','ad_post.fk_sub_category_id','sub_category.id')
                    ->leftJoin('category','sub_category.fk_category_id','category.id')
                    ->leftJoin('last_step_category','ad_post.fk_last_step_id','last_step_category.id')
                    ->select('ad_post.*','division_town.name as division_name','area.area_name','sub_category_name','last_step_category_name','post_photo.photo_one','category.name as cat_name','category.link as cat_link','sub_category.id as sub_id','last_step_category.id as last_id','users.name as creator')
                    ->where('ad_post.status',1)
                    ->where('ad_post.is_approved',1)
                    ->orderBy('ad_post.id','DESC');
        return $adPost;
    }
    static function photoUpload($request,$id){
        $photos=array(
            'photo_one'=>'',
            'photo_two'=>'',
            'photo_three'=>'',
            'photo_four'=>'',
            'fk_post_id'=>'',
            );
        $insert='';
        if ($request->hasFile('photo_one')) {
                $photo_one=$request->file('photo_one');
                $fileType=$photo_one->getClientOriginalExtension();
                $fileName=rand(1,1000).date('dmyhis').".".$fileType;
                $path=base_path().'/images/post/big/'.date('Y/m/d');
                if (!is_dir($path)) {
                    mkdir("$path",0777,true);
                    }
                $path2=base_path().'/images/post/small/'.date('Y/m/d');
                if (!is_dir($path2)) {
                    mkdir("$path2",0777,true);
                    }
                /*$fileName=$photo_one->getClientOriginalName();*/
                $img = Image::make($photo_one);
                $img->resize(400, 260);
                $img->save('images/post/big/'.date('Y/m/d/').$fileName);
                $img->resize(100, 80);
                $img->save('images/post/small/'.date('Y/m/d/').$fileName);
                $photos['photo_one']=date('Y/m/d/').$fileName;
            }
            if ($request->hasFile('photo_two')) {
                $photo_two=$request->file('photo_two');
                $fileType=$photo_two->getClientOriginalExtension();
                $fileName=rand(1,1000).date('dmyhis').".".$fileType;
                $img = Image::make($photo_two);
                $img->resize(400, 260);
                $img->save('images/post/big/'.date('Y/m/d/').$fileName);
                $img->resize(100, 80);
                $img->save('images/post/small/'.date('Y/m/d/').$fileName);
                $photos['photo_two']=date('Y/m/d/').$fileName;
            }
            if ($request->hasFile('photo_three')) {
                $photo_three=$request->file('photo_three');
                $fileType=$photo_three->getClientOriginalExtension();
                $fileName=rand(1,1000).date('dmyhis').".".$fileType;
                $img = Image::make($photo_three);
                $img->resize(400, 260);
                $img->save('images/post/big/'.date('Y/m/d/').$fileName);
                $img->resize(100, 80);
                $img->save('images/post/small/'.date('Y/m/d/').$fileName);
                $photos['photo_three']=date('Y/m/d/').$fileName;
            }
            if ($request->hasFile('photo_four')) {
                $photo_four=$request->file('photo_four');
                $fileType=$photo_four->getClientOriginalExtension();
                $fileName=rand(1,1000).date('dmyhis').".".$fileType;
                $img = Image::make($photo_four);
                $img->resize(400, 260);
                $img->save('images/post/big/'.date('Y/m/d/').$fileName);
                $img->resize(100, 80);
                $img->save('images/post/small/'.date('Y/m/d/').$fileName);
                $photos['photo_four']=date('Y/m/d/').$fileName;
            }
           $insert= DB::table('post_photo')->insert([
                'photo_one'=>$photos['photo_one'],
                'photo_two'=>$photos['photo_two'],
                'photo_three'=>$photos['photo_three'],
                'photo_four'=>$photos['photo_four'],
                'fk_post_id'=>$id,
                ]);
            return $insert;
    }
    static function photoUpdate($request,$id){
        $data=DB::table('post_photo')->where('fk_post_id',$id)->first();
    	$photos=array(
			'fk_post_id'=>$id,
    		);
    	$insert='';
    	if ($request->hasFile('photo_one')) {
                $path=base_path().'/images/post/big/'.date('Y/m/d');
                if (!is_dir($path)) {
                    mkdir("$path",0777,true);
                    }
                $path2=base_path().'/images/post/small/'.date('Y/m/d');
                if (!is_dir($path2)) {
                    mkdir("$path2",0777,true);
                    }

                $photo_one=$request->file('photo_one');
                $fileType=$photo_one->getClientOriginalExtension();
                $fileName=rand(1,1000).date('dmyhis').".".$fileType;
                /*$fileName=$photo_one->getClientOriginalName();*/
                $img = Image::make($photo_one);
                $img->resize(400, 260);
                $img->save('images/post/big/'.date('Y/m/d/').$fileName);
                $img->resize(100, 80);
                $img->save('images/post/small/'.date('Y/m/d/').$fileName);
                $photos['photo_one']=date('Y/m/d/').$fileName;
                /*Delete old photo*/
                $img_path1='images/post/big/'.$data->photo_one;
                $img_path2='images/post/small/'.$data->photo_one;

                if($data->photo_one!=null){
                    if(file_exists($img_path1)){
                        unlink($img_path1);
                    }
                    if(file_exists($img_path2)){
                        unlink($img_path2);
                    }
                }
            }
            if ($request->hasFile('photo_two')) {
                $photo_two=$request->file('photo_two');
                $fileType=$photo_two->getClientOriginalExtension();
                $fileName=rand(1,1000).date('dmyhis').".".$fileType;
                $img = Image::make($photo_two);
                $img->resize(400, 260);
                $img->save('images/post/big/'.date('Y/m/d/').$fileName);
                $img->resize(100, 80);
                $img->save('images/post/small/'.date('Y/m/d/').$fileName);
                $photos['photo_two']=date('Y/m/d/').$fileName;
                /*Delete old photo*/
                $img_path1='images/post/big/'.$data->photo_two;
                $img_path2='images/post/small/'.$data->photo_two;

                if($data->photo_two!=null){
                    if(file_exists($img_path1)){
                        unlink($img_path1);
                    }
                    if(file_exists($img_path2)){
                        unlink($img_path2);
                    }
                }
            }
            if ($request->hasFile('photo_three')) {
                $photo_three=$request->file('photo_three');
                $fileType=$photo_three->getClientOriginalExtension();
                $fileName=rand(1,1000).date('dmyhis').".".$fileType;
                $img = Image::make($photo_three);
                $img->resize(400, 260);
                $img->save('images/post/big/'.date('Y/m/d/').$fileName);
                $img->resize(100, 80);
                $img->save('images/post/small/'.date('Y/m/d/').$fileName);
                $photos['photo_three']=date('Y/m/d/').$fileName;
                /*Delete old photo*/
                $img_path1='images/post/big/'.$data->photo_three;
                $img_path2='images/post/small/'.$data->photo_three;

                if($data->photo_three!=null){
                    if(file_exists($img_path1)){
                        unlink($img_path1);
                    }
                    if(file_exists($img_path2)){
                        unlink($img_path2);
                    }
                }
            }
            if ($request->hasFile('photo_four')) {
                $photo_four=$request->file('photo_four');
                $fileType=$photo_four->getClientOriginalExtension();
                $fileName=rand(1,1000).date('dmyhis').".".$fileType;
                $img = Image::make($photo_four);
                $img->resize(400, 260);
                $img->save('images/post/big/'.date('Y/m/d/').$fileName);
                $img->resize(100, 80);
                $img->save('images/post/small/'.date('Y/m/d/').$fileName);
                $photos['photo_four']=date('Y/m/d/').$fileName;
                /*Delete old photo*/
                $img_path1='images/post/big/'.$data->photo_four;
                $img_path2='images/post/small/'.$data->photo_four;

                if($data->photo_four!=null){
                    if(file_exists($img_path1)){
                        unlink($img_path1);
                    }
                    if(file_exists($img_path2)){
                        unlink($img_path2);
                    }
                }
            }
            if(count($data)>0){
                $update=DB::table('post_photo')->where('fk_post_id',$id)->update($photos);
            }else{
                $update=DB::table('post_photo')->create($photos);
            }
            return $update;
    }

    static function deletePhoto($id){
        $data=DB::table('post_photo')->where('fk_post_id',$id)->first();
        $img_path1='images/post/big/';
        $img_path2='images/post/small/';
        if(count($data)>0){
        $photo=$data->photo_one;
         if($photo!=null){
            if(file_exists($img_path1.$photo)){
                unlink($img_path1.$photo);
            }
            if(file_exists($img_path2.$photo)){
                unlink($img_path2.$photo);
            }
        }
        $photo=$data->photo_two;
         if($photo!=null){
            if(file_exists($img_path1.$photo)){
                unlink($img_path1.$photo);
            }
            if(file_exists($img_path2.$photo)){
                unlink($img_path2.$photo);
            }
        }
        $photo=$data->photo_three;
         if($photo!=null){
            if(file_exists($img_path1.$photo)){
                unlink($img_path1.$photo);
            }
            if(file_exists($img_path2.$photo)){
                unlink($img_path2.$photo);
            }
        }
        $photo=$data->photo_four;
         if($photo!=null){
            if(file_exists($img_path1.$photo)){
                unlink($img_path1.$photo);
            }
            if(file_exists($img_path2.$photo)){
                unlink($img_path2.$photo);
            }
        }
    return DB::table('post_photo')->where('fk_post_id',$id)->delete();
    }else{
        return 0;
    }

    }








}
