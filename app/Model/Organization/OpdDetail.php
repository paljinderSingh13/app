<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class OpdDetail extends Model
{
	protected $fillable = ['opd_id', 'day', 'shift_id', 'start_time', 'end_time', 'average_patient', 'status'];

    public function __construct(){
    	$this->table = "org_".Session::get('org_id')."_opd_details";
    }
    public function shift() {
    	return $this->belongsTo('App\Model\Organization\Shift','shift_id','id');
    }


}
