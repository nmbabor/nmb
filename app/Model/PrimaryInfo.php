<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PrimaryInfo extends Model
{
    protected $table='about_company';
    protected $fillable=['company_name','logo','location','details','mobile_no','email','short_description','description','map_embed','fb_link','ataglance'];
}
