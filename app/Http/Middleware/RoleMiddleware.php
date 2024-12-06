<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $roles)
    {
        if (!Auth::check() || !Auth::user()->hasRole($roles)) {
            //return response()->json(['You do not have permission to access for this page.']);
            return redirect()->route('expired');
            //return $next($request);
        }
        
        return $next($request);
    }
}
