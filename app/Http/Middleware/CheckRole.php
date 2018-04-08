<?php

namespace App\Http\Middleware;

use Closure;
use OrgSidebar;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    protected function remove_unwanted($uri){
         $uri = str_replace('/{id}','',$current_route->uri);
    }
    public function handle($request, Closure $next)
    {
        $role_id = OrgSidebar::role_id();
        if($role_id!=1){
            $module = OrgSidebar::module();
            $role_permisson = OrgSidebar::role_permisson();
            $current_route =  $request->route();
            $uri = str_replace(['/{id}', '/{id?}'],'',$current_route->uri);
            $current_module_id = array_search($uri, $module);

            if(isset($role_permisson[$current_module_id]) && $role_permisson[$current_module_id]==0 ){
                dd('Not have permisson');
            }
        }
        return $next($request);
    }
}
