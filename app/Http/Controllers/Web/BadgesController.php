<?php

namespace App\Http\Controllers\Web;

use App\Services\ImageProcessingService;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Badge;

class BadgesController extends WebController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): Response
    {
        $badges = Badge::paginate(10);
        return response()->view('admin.badges.index', compact('badges'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Badge  $badge
     * @return \Illuminate\Http\Response
     */
    public function show(Badge $badge): Response
    {
        return response()->view('badges.show', compact('badge'));
    }

}
