<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CvTraining extends Model
{
    protected $table='cv_training';
    protected $fillable=['fk_cv_id','created_by','organization','location','course_title','course_topic','year','duration'];
}
