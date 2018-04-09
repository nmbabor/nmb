<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LastStepCategory extends Model
{
    protected $table='last_step_category';
    protected $fillable=['last_step_category_name','status','serial_num','description','fk_sub_category_id','created_by','updated_by'];
}
