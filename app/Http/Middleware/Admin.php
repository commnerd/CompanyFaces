<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;

class Admin
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
        if ( \Auth::check() && \Auth::user()->superuser )
        {
            return $next($request);
        }

        return redirect()->back();
    }
}
