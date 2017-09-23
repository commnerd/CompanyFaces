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
        return $next($request);

        if(Setting::show('game') && \Session::has('game')) {
            return response(null, 302)->header('Location', route('game.index'));
        }
        return $next($request);
    }
}
