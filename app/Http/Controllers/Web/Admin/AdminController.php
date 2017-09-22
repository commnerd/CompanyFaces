<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Web\WebController;
use Illuminate\Support\Facades\Auth;
use \App\Setting;

class AdminController extends WebController
{
    public function __construct() {
        parent::__construct();
        $this->middleware('admin');
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::all();
        return view('admin.index', compact('settings'));
    }

/*
    protected function guard()
    {
        return Auth::guard('auth');
    }
    */
}
