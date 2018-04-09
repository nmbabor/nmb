<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CvLanguage extends Model
{
     protected $table='cv_language';
    protected $fillable=['fk_cv_id','created_by','language_name','reading','writing','speaking'];
}
