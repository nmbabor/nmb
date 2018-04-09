<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SubCatWiseBrand extends Model
{
    protected $table='sub_category_wise_brand';
    protected $fillable=['fk_sub_category_id','fk_brand_id'];
}
