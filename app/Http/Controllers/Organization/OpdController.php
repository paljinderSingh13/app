<?php

namespace App\Http\Controllers\Organization;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Opd;
use App\Model\Organization\OpdDetail;
use App\Model\Organization\User;
use App\Model\Organization\Shift;

class OpdController extends Controller
{
  	public function list($id=null){
    	$data = Opd::all();
    	if(!empty($id)){
    		$data['id'] = $id;
    	}
    	$doctor = User::where(['type'=>'dr','status'=>1])->pluck('name','id');
    	$shift = Shift::where('status',1)->pluck('name','id');
    	return view('organization.opd.list',compact('data','doctor','shift'));
    }
    public function save(Request $request){
    	// dd($request->all());
    	$opd = Opd::firstOrNew(['name'=>$request['name'], 'dr_id'=>$request['dr_id']]);
    	$opd->fill($request->all());
    	$opd->shifts = json_encode($request['shifts']);
    	$opd->save();
    	$opd_id = $opd->id;
    	foreach ($request['day'] as $day => $dayVal) {
    		foreach ($request['shifts'] as $shift_key => $shift_value) {
    			$start = $request[$day][$shift_value]['start'];
    			$end = $request[$day][$shift_value]['end'];
	    		$opd_detail = OpdDetail::firstOrNew(['opd_id'=>$opd_id, 'day'=>$day,'shift_id'=>$shift_value]);
	    		$opd_detail->opd_id = $opd->id;
	    		$opd_detail->day = $day;
	    		$opd_detail->shift_id = $shift_value;
	    		$opd_detail->start_time = $request[$day][$shift_value]['start'];
                $opd_detail->end_time = $request[$day][$shift_value]['end'];
	    		$opd_detail->average_patient = $request[$day][$shift_value]['average_patient'];
	    		$opd_detail->save();
    		}
    	}
    	return redirect('admin/opds');
    }
    public function delete($id){
 		Opd::where('id',$id)->delete();
    	return redirect('admin/opds');
    }
    public function edit($id){
    	dump($id);
    } 
}
