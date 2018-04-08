<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class Role extends Model
{
	protected $fillable = ['name', 'status'];
    public function __construct(){
        if(Session::has('org_id')){
          $this->table = 'org_'.Session::get('org_id').'_roles';
        }
    }
}
