<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Gate;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        switch ($role) {
            case 'superadmin':
                break;
            case 'admin':
                if(Gate::allows("get-favorites"))
                    return $next($request);
                else return response("", 403);
            default:
                return $next($request);
        }
    }
}
