<?php

namespace App\Http\Controllers\Web\Admin;

use \App\Http\Controllers\Web\WebController;

class AdminController extends WebController
{
    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.index');
    }
}
