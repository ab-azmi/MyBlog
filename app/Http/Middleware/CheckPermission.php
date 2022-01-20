<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPermission
{
    
    public function handle(Request $request, Closure $next)
    {
        //1. Get the route name
        $route_name = $request->route()->getName();
        //2. Get permission for authtenticated person
        $routes_arr = auth()->user()->role->permissions->toArray();
        //3. Compare this route name with user permissions
        foreach($routes_arr as $route){
            //4. If route name is one of these permissions
            if($route['name'] === $route_name){
                //5. allow user to access
                return $next($request);
            }
        }
        
        //6. Else, abort 403 Unauthorized
        abort(403, 'Access Denied | Unauthorized');
    }
}
