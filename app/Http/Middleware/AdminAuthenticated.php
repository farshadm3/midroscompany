<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;

class AdminAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

//        if ($request->user()->hasRole($request->user()->roles))
//            return $next($request);
//
//        foreach ($request->user()->permissions as $permission)
//        {
//            if ($request->user()->hasPermission($permission))
//                return $next($request);
//        }

        if($request->user()->isAdminUser()) {
            return $next($request);
        }

        return redirect('/');
    }
}
