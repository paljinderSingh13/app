<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class Appointment extends Model
{
	public function __construct(){
		$this->table = "org_".Session::get('org_id')."_appointments";
	}
	protected $fillable = ['opd_id','patient_id', 'date','shift_id','time','token_no','status'];
    
}
