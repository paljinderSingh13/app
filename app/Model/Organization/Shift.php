<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;
class Shift extends Model
{
    public function __construct(){
    	$this->table = "org_".Session::get('org_id')."_shifts";
    }
    protected $fillable = ['name', 'status'];
    public function opd_shift(){
    	return $this->hasMany('App\Model\Organization\OpdDetail','shift_id','id');
    }
}
