<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\User;

class HomeController extends WebController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::inRandomOrder()->limit(500)->get();
        return view('search', ['users' => $users]);
    }
}
