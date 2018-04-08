<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckAdminAuthenicate {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard=null)
    {
        if(!Auth::guard('admin')->check()){
            return redirect('admin/login');
        }
        return $next($request);
    }
}
