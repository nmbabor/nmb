<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Eshop extends Model
{
    protected $table='eshop_list';
    protected $fillable=['subdomain','eshop_name','title','description','location','status','is_approved','approved_by','fk_user_id','db_name'];
}
