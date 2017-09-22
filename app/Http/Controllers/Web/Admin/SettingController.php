<?php

namespace App\Http\Controllers\Web\Admin;

use \Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Setting;

class SettingController extends AdminController
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): Response
    {
        foreach(Setting::all() as $setting) {
            $setting->enabled = $request->input($setting->slug) == "on" ? true : false;
            $setting->save();
        }
        return response(null, 302)->header('Location', route('admin.index'));
    }
}
