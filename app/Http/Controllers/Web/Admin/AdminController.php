<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Web\WebController;
use Illuminate\Support\Facades\Auth;

class AdminController extends WebController
{
    public function __construct() {
        $this->middleware('admin');
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index');
    }

/*
    protected function guard()
    {
        return Auth::guard('auth');
    }
    */
}
