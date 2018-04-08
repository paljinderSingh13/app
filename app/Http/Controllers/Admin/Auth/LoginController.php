<?php

namespace App\Http\Controllers\Admin\Auth;

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
    protected $redirectTo = '/admin/module';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        
        $this->middleware('guest:admin')->except('logout');
    }
    public function showLoginForm( Request $request){
        dump('it is admin here');

        return view('organization.login'); 
    }
    public function login(Request $request){
        
        // dd(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password]));
        if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password])) {
            return redirect('admin/module');
         }else{
            return back();
         }
     }
    protected function guard() {
        return Auth::guard('admin');
    }
    public function logout(Request $request){
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
}
