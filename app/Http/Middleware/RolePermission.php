<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class RolePermission
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
      
        $all_permissions  = Session::get('all_permissions') ?? [];
        $cur_url = $_SERVER['REQUEST_URI'];
        if(!empty($all_permissions)){ 
            if(!in_array($cur_url,$all_permissions)){
                abort(404);
            }
        }
        return $next($request);
    }
}