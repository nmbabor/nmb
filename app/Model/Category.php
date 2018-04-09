<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table='category';
    protected $fillable=['name','status','type','serial_num','description','icon_photo','icon_class','created_by','updated_by','link','post_type','short_description'];
}
