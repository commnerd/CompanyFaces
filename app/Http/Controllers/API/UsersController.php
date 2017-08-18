<?php

namespace App\Http\Controllers\API;

use \App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\User;

class UsersController extends Controller
{
    public function search(Request $request) {
        $query = User::parseNameAndPosition($request->input('query'));
        dd($query);
        $users = User::all();
        return response()->json($users);
    }
}
