<?php

namespace App\Http\Controllers\Organization;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class DashboardController extends Controller
{
	public function __construct(){
		$this->middleware('auth.org');
	}
    public function dashboard(){
    	dump(Session::all());
    	dump('this is organization working multi auth good now ');
    	return view('organization.dashboard');
    }
}
