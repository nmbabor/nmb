<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SubCatWiseField extends Model
{
    protected $table='sub_category_wise_field';
    protected $fillable=['fk_sub_category_id','fk_post_field_id'];
}
