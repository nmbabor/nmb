<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $table='user_info';
    protected $fillable=['fk_division_id','fk_area_id','fk_user_id','address'];
}
