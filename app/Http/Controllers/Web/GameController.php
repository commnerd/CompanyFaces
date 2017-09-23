<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\User;

class GameController extends WebController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): Response
    {
        if(!\Session::has('game')) {
            $game = [
                'users' => User::inRandomOrder()->limit(10)->get(),
                'guesses' => []
            ];
            \Session::put('game', $game);
        }

        $game = \Session::get('game');

        $user = $game['users'][sizeof($game['guesses'])];

        $names = array_map(function($user) {
            return User::formatSupervisorLabel(new User($user));
        }, User::inRandomOrder()->limit(3)->get()->toArray());
        if(!in_array($user->supervisorLabel, $names)) {
            $names[] = $user->supervisorLabel;
        }

        return response()->view('game.index', compact('user', 'names'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

}
