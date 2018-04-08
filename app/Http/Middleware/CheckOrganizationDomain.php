<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\Organization\Organization;
use Session;

class CheckOrganizationDomain
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
        $domain = explode('.', $request->getHost());
        $parameters = $domain[0];
        $data = Organization::select('id')->where('sub_domain', $parameters);
            if($data->exists()){
                $org_id = $data->first()->id;
                Session::put('org_id', $org_id);
                
            }else{
                dump("this is not registerd org domian");
            }
        return $next($request);
    }
}
