<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Admin\Module;
class ModuleController extends Controller
{
    public function module()
    {
        
    	$data['route_list'] = Module::route_list();
    	$data['modules'] = Module::where('parent',0)->get();
    	return view('admin.module.list', compact('data'));

    }

    public function create(Request $request){
    	$route_list = Module::route_list();
    	return view('admin.module.create',['data'=>$route_list]);
    }
    public function save(Request $request){

    	$module  = new Module();
    	$module->fill($request->all());
    	$module->save();
    	dd($module->id);
    }
}
