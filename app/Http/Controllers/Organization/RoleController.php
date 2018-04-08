<?php

namespace App\Http\Controllers\Organization;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Role;

class RoleController extends Controller
{
    public function list($id=null){
    	$data = Role::all();
    	if(!empty($id)){
    		$data['id'] = $id;
    		// dump($data->where('id',$id)->first());
    	}
    	return view('organization.role.list',compact('data'));
    }
    public function save(Request $request){
    	$role = new Role();
    	$role->name =  $request->name;
    	$role->save();
    	return redirect('admin/roles');
    }
    public function delete($id){
 		Role::where('id',$id)->delete();
    	return redirect('admin/roles');
    }
    public function edit($id){
    	dump($id);
    } 
}
