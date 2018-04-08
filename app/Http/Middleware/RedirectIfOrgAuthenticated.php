<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class RedirectIfOrgAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
       // dd(Auth::guard('org')->check());
        if(Auth::guard('org')->check()) {
            redirect('admin/dashboard');
        }else{
            redirect('admin/login');
        }
        return $next($request);
    }
}
