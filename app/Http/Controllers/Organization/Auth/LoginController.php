<?php

namespace App\Http\Controllers\Organization\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Model\Organization\User;
use Illuminate\Http\Request;
use Auth;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest:org')->except('logout');
    }
    public function showLoginForm( Request $request){
        dump('it is here');

        return view('organization.login'); 
    }
    public function login(Request $request){
        if(Auth::guard('org')->attempt(['email'=>$request->email,'password'=>$request->password])) {
            return redirect('admin/dashboard');
         }else{
            return back();
         }
     }
    protected function guard() {
        return Auth::guard('org');
    }
    public function logout(Request $request){
        Auth::guard('org')->logout();
        return redirect('admin/login');
    }
}
