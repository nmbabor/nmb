<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table='page';
    protected $fillable=['name','title','description','status','link','file'];
}
