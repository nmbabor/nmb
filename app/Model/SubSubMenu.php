<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SubSubMenu extends Model
{
    protected $table='sub_sub_menu';
    protected $fillable=['name','url','status','serial_num','fk_sub_menu_id'];
}
