<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class Opd extends Model
{
    public function __construct(){
    	$this->table = "org_".Session::get('org_id')."_opds";
    }
    public function opd_detail(){
    	return $this->hasMany('App\Model\Organization\OpdDetail','opd_id','id');
    }
    public function doctor_detail(){
    	return $this->belongsTo('App\Model\Organization\User','dr_id','id')->where('type','dr');
    }

    protected $fillable = ['name','dr_id'];
}
