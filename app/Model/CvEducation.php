<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CvEducation extends Model
{
    protected $table='cv_education';
    protected $fillable=['fk_cv_id','created_by','exam_title','subject','institute','result','pass_year','duration'];

}
