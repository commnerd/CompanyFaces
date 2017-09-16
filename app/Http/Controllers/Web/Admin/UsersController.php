<?php

namespace App\Http\Controllers\Web\Admin;

use App\Services\ImageProcessingService;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Image;
use App\User;

class UsersController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): Response
    {
        $users = User::paginate(10);
        return response()->view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): Response
    {
        return response()->view('admin.users.create');
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

        $this->validate($request, User::getValidationRules(User::VALIDATION_CREATE));
        $image = ImageProcessingService::processImage($request->input('photo'), $x, $y, $wh);
        if(!$image) {
            App::abort(500, "Something went wrong.");
        }
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'image_id' => $image->id,
            'supervisor_user_id' => User::supervisorLabelToId($request->input('supervisor')),
            'position' => $request->input('position'),
            'password' => bcrypt($request->input('password')),
            'biography' => $request->input('biography'),
        ]);
        session()->flash('success', $request->input('name').'\'s profile successfully created.');
        return response(null, 302)->header('Location', route('admin.users.index'));
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
        $user = User::findOrFail($id);
        return response()->view('admin.users.edit', compact('user'));
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
        $passwordSet = !empty($request->input('password')) && !empty($request->input('password_confirmation'));
        $this->validate($request, User::getValidationRules(User::VALIDATION_UPDATE, $id, $passwordSet));
        $user = User::where('id', $id)->firstOrFail();

        if($processImage) {
            $user->image_id = $image->id;
        }

        foreach($user->toArray() as $field => $value) {
            if(!empty($request->input($field))) {
                $user->{$field} = $request->input($field);
            }
        }
        $user->save();
        session()->flash('success', $request->input('name').'\'s profile successfully updated.');
        return response(null, 302)->header('Location', route('admin.users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): Response
    {
        $user = User::findOrFail($id);
        User::linkSubordinatesToSupervisor($user);
        $user = User::findOrFail($id);
        User::destroy($id);
        session()->flash('success', $user->name.'\'s profile successfully deleted.');
        return response(null, 302)->header('Location', route('admin.users.index'));
    }
}
