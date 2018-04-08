<?php

namespace App\Http\Controllers\Organization\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Permisson;
use App\Model\Admin\Module;


class PermissonController extends Controller
{


    public function permisson($role_id){

		
    	$data['role_id'] = $role_id;
    	$role_module = Permisson::where('role_id', $role_id);

    	if($role_module->exists()){
    		$data['role_module'] = $role_module->pluck('status', 'module_id')->toArray();
    	}
    	$data['module'] = Module::where('parent',0)->get();
    	return view('organization.permisson.list', compact('data') );
    }


// Save update permisson    
    public function save(Request $request){
		if(empty($request['module_id'])){
		    	Permisson::where(['role_id'=>$request['role_id']])->update(['status'=>0]);
		}else{
    		foreach ($request['module_id'] as $key => $value) {
	    		$check_permisson = Permisson::where(['role_id'=>$request['role_id'], 'module_id'=>$value]);
	    		if($check_permisson->exists()){
	    			$check_permisson->update(['status'=>1]);

	    		}else{
	    			$permisson = new Permisson();
	    			$permisson->fill(['module_id'=>$value, 'role_id'=> $request['role_id'], 'status'=>1]);
	    			$permisson->save();
	    		}
    		}
    		Permisson::where(['role_id'=>$request['role_id']])->whereNotIn('module_id',$request['module_id'])->update(['status'=>0]);
    	}	
    return back();
    }


}
