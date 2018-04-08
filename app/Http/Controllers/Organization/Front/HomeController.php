<?php

namespace App\Http\Controllers\Organization\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Opd;
use App\Model\Organization\OpdDetail;
use App\Model\Organization\Shift;
use App\Model\Organization\Appointment;
use Auth;
use Session;
class HomeController extends Controller
{
    public function view(){
        $pendng_appointment = Appointment::where('date','>=',date('d-m-Y') )->where('patient_id', Auth::id())->get();
        //dd($pendng_appointment);
    	$data['opds'] = Opd::select(['id','dr_id','name'])->with(['doctor_detail', 'opd_detail.shift:id,name'])->get();
    	return view('organization.front.home',compact('data'));
    }
    public function opd_detail($id){
    	$data = Opd::select(['id','dr_id','name','shifts'])->where('id', $id)->with(['doctor_detail', 'opd_detail.shift:id,name'])->first();
    	$shift_id = json_decode($data->shifts);
    	$shift = shift::whereIn('id',$shift_id)->pluck('name','id');
    	return view('organization.front.opd_detail',compact('data','shift'));
    }
}
