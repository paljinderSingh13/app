<?php 

namespace App\Helpers;
use App\Model\Organization\Permisson;
use App\Model\Admin\Module;
use Auth;

/**
* 
*/


class OrgSideBar 
{
	

	public static function role_id(){

		if(Auth::guard('org')->check()){
			return Auth::guard('org')->user()->role_id;
		}
		return;

	}


	public static function role_permisson(){

		if(Auth::guard('org')->check()){
			$role_id = Auth::guard('org')->user()->role_id;
			$permisson = Permisson::where('role_id', $role_id)->pluck('status', 'module_id');
			return $permisson;
		}
		return;
	}


	public static  function draw(){

		if(Auth::guard('org')->check()){
			$module = Module::where('parent',0)->get();
		}else{
			return;
		}
		return 	$module;

	}


	public static  function module(){

		if(Auth::guard('org')->check()){
			$module = Module::pluck('route','id')->toArray();
		}else{
			return;
		}
		return 	$module;
	}


}