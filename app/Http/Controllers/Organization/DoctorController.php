<?php

namespace App\Http\Controllers\Organization;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\User;
use Hash;

class DoctorController extends Controller
{
   public function list(){
   	$data = User::Where('type', 'dr')->get();
   	return view('Organization.doctor.list',compact('data'));
   }
   public function save(Request $request){
   	$dr = new User();
   	$dr->fill($request->except('password'));
   	$dr->type = "dr";
   	$dr->role_id = 5;
   	$dr->password = Hash::make($request->password);
   	$dr->save();
   	return redirect()->route('dr');
   }

   public function delete($id){
   		User::where('id',$id)->delete();
   	return redirect()->route('dr');	
   }
}
