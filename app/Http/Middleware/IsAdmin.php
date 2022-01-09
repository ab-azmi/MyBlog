<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{

    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->role->name === 'admin'){
           return $next($request); 
        }
        
        abort(403, 'Unauthorized');
    }
}
