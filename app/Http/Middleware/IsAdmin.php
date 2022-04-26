<?php

namespace App\Http\Middleware;

use Closure;
use illuminate\Support\Facades\Auth;

class IsAdmin
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
        if(Auth::user() && auth::user()->roles == 'ADMIN')
        {
            return $next($request);
        }

        return redirect('/');
    }
}
