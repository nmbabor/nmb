<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AdManager extends Model
{
    protected $table='ad_manager';
    protected $fillable=['photo','caption','status','photo','link','script','is_photo','fk_page_id','serial_num','fk_category_id'];
}
