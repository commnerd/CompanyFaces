<?php

namespace App\Http\Middleware;

use App\Setting;
use Closure;

class Game
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
        if(Setting::show('game') && \Session::has('game') && $request->path() !== 'game') {
            return redirect()->back();
        }
        return $next($request);
    }
}
