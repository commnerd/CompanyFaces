<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

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
