<?php

namespace App\Http\Middleware;

use \App\Setting as AppSetting;
use Closure;

class Setting
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
        $settings = [];
        foreach(AppSetting::all() as $setting) {
            if($setting->enabled) {
                $settings[] = $setting->slug;
            }
        }
        $pathParts = explode(DIRECTORY_SEPARATOR, $request->path());
        $accepted = false;

        foreach($settings as $setting) {
            if(in_array($setting, $pathParts)) {
                return $next($request);
            }
        }

        \Session::flash('warning', 'This feature is not enabled.');
        return redirect()->back();
    }
}
