<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PostField extends Model
{
    protected $table='post_field';
    protected $fillable=['title','type','value','part_of','required','created_by','updated_by','status'];
}
