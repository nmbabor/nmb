<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CvEmployment extends Model
{
    protected $table='cv_employment';
    protected $fillable=['fk_cv_id','created_by','organization','location','designation','responsibilities','experience','till_now'];
}
