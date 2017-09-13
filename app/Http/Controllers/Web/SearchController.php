<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\User;

class SearchController extends WebController
{
    public function list(Request $request): Response {
        $users = User::getUsersFromSupervisorLabel($request->input('terms'));
        if(sizeof($users) == 1) {
            return response(null, 302)->header('Location', '/users/'.$users[0]->id);
        }
        return response()->view('users.search', compact('users'));
    }
}
