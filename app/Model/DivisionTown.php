<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DivisionTown extends Model
{
    protected $table='division_town';
    protected $fillable=['name','type','status','link'];
}
