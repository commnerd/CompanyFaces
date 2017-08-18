<?php

namespace App\Http\Controllers\API;

use \App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\User;

class UsersController extends Controller
{
    public function search(Request $request) {
        $users = User::getUsersFromSupervisorLabel($request->input('term'));
        return response()->json(array_map(function($user) { return $user['supervisorLabel']; }, $users));
    }
}
