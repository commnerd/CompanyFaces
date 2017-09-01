<?php

namespace App\Http\Controllers\Web;

use App\Services\ImageUploadService;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Image;
use App\User;

class UsersController extends WebController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): Response
    {
        $users = User::orderBy("name")->get();
        if(sizeof($users) == 1) {
            return response(null, 302)->header('Location', '/users/'.$users[0]->id);
        }
        return response()->view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): Response
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): Response
    {
        $image = ImageUploadService::processImage($request->input('photo'));
        if(!$image) {
            App::abort(500, "Something went wrong.");
        }
        return User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'image_id' => $image->id,
            'supervisor_user_id' => User::supervisorLabelToId($request->input('supervisor')),
            'position' => $request->input('position'),
            'password' => bcrypt($request->input('password')),
            'biography' => empty($request->input('biography')) ? '' : $request->input('biography'),
        ]);
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): Response
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): Response
    {
        //
    }
}
