<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PostFieldValue extends Model
{
    protected $table='post_field_value';
    protected $fillable=['fk_post_field_id','field_value','fk_post_id'];
}
