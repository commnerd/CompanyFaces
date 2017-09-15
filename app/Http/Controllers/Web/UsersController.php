<?php

namespace App\Http\Controllers\Web;

use App\Services\ImageProcessingService;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Image;
use App\User;

class UsersController extends WebController
{
    public function search(Request $request): Response {
        $users = User::getUsersFromSupervisorLabel($request->input('terms'));
        if(sizeof($users) == 1) {
            return response(null, 302)->header('Location', '/users/'.$users[0]->id);
        }
        return response()->view('users.search', compact('users'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): Response
    {
        $user = User::findOrFail($id);
        return response()->view('users.show', compact('user'));
    }
}
