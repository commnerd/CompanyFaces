<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\User;

class SearchController extends WebController
{
    public function list(Request $request): View {
        $users = User::getUsersFromSupervisorLabel($request->input('terms'));
        if(sizeof($users) == 1) {
            return view('user.profile', ['user' => $users[0]]);
        }
        return view('user.list', compact('users'));
    }
}
