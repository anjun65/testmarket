<?php

namespace App\Http\Middleware;

use Closure;
use illuminate\Support\Facades\Auth;

class IsSales
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user() && auth::user()->roles == 'SALES')
        {
            return $next($request);
        }

        return redirect('/');
    }
}
