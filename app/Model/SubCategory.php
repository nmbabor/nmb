<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table='sub_category';
    protected $fillable=['sub_category_name','status','serial_num','description','fk_category_id','created_by','updated_by'];
}
