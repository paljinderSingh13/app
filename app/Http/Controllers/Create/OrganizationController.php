<?php

namespace App\Http\Controllers\Create;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Organization as ORG;
use App\Model\Organization\User as ORG_ADMIN_USER;
//use Artisan;
use Session;
use Hash;
use DB;
class OrganizationController extends Controller
{

	/**
	* organization validation 
	*/
	protected function validation($request){
		$validatedData = $request->validate([
		        'email' => 'required|unique:organizations|max:255',
		        'name'=> 'required',
		    ]);	
		    return $validatedData;	
	}
	protected function create_organization_database($existed_id , $new_id)
    {
        $organizations = DB::select(" SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='opd' and TABLE_NAME like 'org_".$existed_id."%' ");
        if(!empty($organizations)){
            foreach (json_decode(json_encode($organizations),true)  as $orgKey => $orgValue) {
                $existed = $orgValue['TABLE_NAME'];
                //if($existed != "ocrm_".$existed_id."_users"){
                  $new = str_replace($existed_id, $new_id, $existed);
                  DB::select("CREATE TABLE ".$new." LIKE ".$existed);
                  DB::select("INSERT ".$new." SELECT * FROM ".$existed);
                //}
            } 
            return 'table_exist';
        }else{
            return 'table_not_exist';
            }
    }
	public function create(Request $request){
 		if($request->isMethod('post')){
			dump($request->all());
			$org = new ORG();
			$org->fill($request->except(['password']));
			$org->password = Hash::make($request->password);
			$org->save();
			$this->create_organization_database(1 , $org->id);
			Session::put('org_id', $org->id);
			$org_admin_user = new ORG_ADMIN_USER();
			$org_admin_user->fill($request->except(['password']));
			$org_admin_user->password = Hash::make($request->password);
			$org_admin_user->role_id = 1;

			$org_admin_user->save();
		}

		return view('organization.create');
	}

	public function set_domain($domain){
		dd(Session::all(),  $domain,'Dashboard');
	}

	
}
