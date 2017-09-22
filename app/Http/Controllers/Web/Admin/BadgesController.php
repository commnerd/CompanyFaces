<?php

namespace App\Http\Controllers\Web\Admin;

use App\Services\ImageProcessingService;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Badge;

class BadgesController extends AdminController
{
    public function __construct() {
        parent::__construct();

        $this->middleware('setting');
    }
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): Response
    {
        return response()->view('admin.badges.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): Response
    {
        $x = $request->input('photo_crop_x');
        $y = $request->input('photo_crop_y');
        $wh = $request->input('photo_crop_w');

        $this->validate($request, Badge::getValidationRules(Badge::VALIDATION_CREATE));
        $image = ImageProcessingService::processImage($request->input('photo'), $x, $y, $wh);
        if(!$image) {
            App::abort(500, "Something went wrong.");
        }
        Badge::create([
            'image_id' => $image->id,
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'stand_alone' => $request->input('stand_alone')
        ]);
        session()->flash('success', $request->input('title').' badge successfully created.');
        return response(null, 302)->header('Location', route('admin.badges.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Badge  $badge
     * @return \Illuminate\Http\Response
     */
    public function show(Badge $badge): Response
    {
        return response()->view('admin.badges.show', compact('badge'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Badge  $badge
     * @return \Illuminate\Http\Response
     */
    public function edit(Badge $badge)
    {
        return response()->view('admin.badges.edit', compact('badge'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Badge  $badge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Badge $badge): Response
    {
        $image = null;

        $x = $request->input('photo_crop_x');
        $y = $request->input('photo_crop_y');
        $wh = $request->input('photo_crop_w');

        $processImage = !empty($x) && !empty($y) && !empty($wh);

        if($processImage) {
            $image = ImageProcessingService::processImage($request->input('photo'), $x, $y, $wh);
            if(!$image) {
                App::abort(500, "Something went wrong.");
            }
        }
        $this->validate($request, Badge::getValidationRules(Badge::VALIDATION_UPDATE, $id));

        if($processImage) {
            $badge->image_id = $image->id;
        }

        foreach($badge->toArray() as $field => $value) {
            if(!empty($request->input($field))) {
                $badge->{$field} = $request->input($field);
            }
        }
        $badge->save();
        session()->flash('success', $request->input('title').' badge successfully created.');
        return response()->view('admin.badges.edit', compact('badge'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Badge  $badge
     * @return \Illuminate\Http\Response
     */
    public function destroy(Badge $badge): Response
    {
        $badge->destroy($badge->id);
        session()->flash('success', $badge->title.' successfully deleted.');
        return response(null, 302)->header('Location', route('admin.badges.index'));
    }
}
