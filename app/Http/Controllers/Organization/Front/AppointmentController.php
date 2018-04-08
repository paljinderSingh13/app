<?php
namespace App\Http\Controllers\Organization\Front;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Appointment;
use App\Model\Organization\OpdDetail;
use Session;
use Carbon\Carbon;
class AppointmentController extends Controller
{
   protected function calculate_mintue($from, $to){
      $time = new Carbon($from);
      $shift_end_time =new Carbon($to);
      $totalDuration = $time->diffInMinutes($shift_end_time, false);
      return $totalDuration;
   }
   protected function opd_details($request){
      if(date('d-m-Y') > $request->date){
         Session::flash('error', 'no book for past date');
         return;
      }
      $date = Carbon::parse($request->date);
      $detail = OpdDetail::select(["opd_id", "day", "shift_id" , "start_time" , "end_time" , "average_patient"] )->where(['day'=>$date->dayOfWeek, 'opd_id'=>$request->opd_id, 'shift_id'=>$request->shift_id])->first();
      if(empty($detail)) {
         Session::flash('error','Dr not attend opd on this day schedule on another day');
         return;
      }
      $totalDuration = $this->calculate_mintue($detail['start_time'], $detail['end_time']);
      //dd('duration' , $totalDuration);
      $per_durnation = $totalDuration/$detail->average_patient;
      $detail->per_durnation = round($per_durnation);
      return $detail;
   } 

   public function save(Request $request){ 
      $opd_detail = $this->opd_details($request);
      if(empty($opd_detail)){
         return back();
      }  
      $appointment = Appointment::select('time', 'token_no')->where($request->except('_token'));
      if($appointment->exists()){
   		$appointment_data =  $appointment->orderBy('token_no','DESC')->first();
   		$request['token_no'] = $appointment_data->token_no + 1;
         $last_time = new Carbon($appointment_data->time);
         $time = $last_time->addMinutes($opd_detail['per_durnation']);
         $request['time'] =  $time->hour.':'.$time->minute;
         if( strtotime($request['time']) > strtotime($opd_detail->end_time)){
            Session::flash('error', 'this session is full try for next one.');
            return back();
         }
   	}else{
   		$request['token_no'] = 1;
         $request['time'] = $opd_detail->start_time;
   	}
   	$apointment = new Appointment();
   	$apointment->fill($request->all());
   	$apointment->save();
   	if($apointment->id){
   		Session::flash('success','Appointment confirmed & your turn no '.$apointment->token_no.' & TIME '.$request['time']);
   		return back();
   	}
   }
}
