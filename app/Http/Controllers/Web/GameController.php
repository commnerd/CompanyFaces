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
                'users' => User::inRandomOrder()->limit(2)->get(),
                'names' => []
            ];
            \Session::put('game', $game);
        }

        $game = \Session::get('game');

        if(sizeof($game['names']) === sizeof($game['users'])) {
            $msgType = 'success';
            $count = sizeof($game['users']);
            $score = $this->score();
            if($score / $count < .5) {
                $msgType = 'danger';
            }
            elseif($score / $count < .75) {
                $msgType = 'warning';
            }
            \Session::forget('game');
            \Session::flash($msgType, "You got $score out of ".$count.".");
            return response(null, 302)->header('Location', route('home'));
        }

        $user = $game['users'][sizeof($game['names'])];

        $names = array_map(function($user) {
            return User::formatSupervisorLabel(new User($user));
        }, User::inRandomOrder()->where('id', '!=', $user->id)->limit(3)->get()->toArray());

        $names[] = User::formatSupervisorLabel($user);

        shuffle($names);
        return response()->view('game.index', compact('user', 'names'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): Response
    {
        $game = \Session::get('game');
        $game['names'][] = $request->input('name');
        \Session::put('game', $game);
        return response(null, 302)->header('Location', route('game.index'));
    }

    /**
     * Score a game
     * @return int The number right
     */
    private function score(): int {
        $game = \Session::get('game');
        $score = 0;
        foreach($game['names'] as $index => $label) {
            if($game['users'][$index]->supervisorLabel === $label) {
                $score++;
            }
        }
        return $score;
    }
}
