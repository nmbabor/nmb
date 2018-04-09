<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    protected $table='job_application';
    protected $fillable=['fk_post_id','fk_user_id','status'];
}
