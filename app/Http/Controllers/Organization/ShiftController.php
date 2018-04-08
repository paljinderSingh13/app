<?php

namespace App\Http\Controllers\Organization;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Shift as shift;
class ShiftController extends Controller
{
   public function list($id=null){
    	$data = shift::all();
    	if(!empty($id)){
    		$data['id'] = $id;
    	}
    	return view('organization.shift.list',compact('data'));
    }
    public function save(Request $request){
    	$shift = new shift();
    	$shift->name =  $request->name;
    	$shift->save();
    	return redirect('admin/shifts');
    }
    public function delete($id){
 		shift::where('id',$id)->delete();
    	return redirect('admin/shifts');
    }
    public function edit($id){
    	dump($id);
    } 
}
