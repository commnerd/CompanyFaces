<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use App\Services\ImageProcessingService;
use App\Http\Controllers\Controller;
use App\Image;
use App\User;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, User::$registrationValidationRules);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $x = $data['photo_crop_x'];
        $y = $data['photo_crop_y'];
        $wh = $data['photo_crop_w'];

        ImageProcessingService::processImage($data['photo'], $x, $y, $wh);

        $image = Image::where('name', $data['photo'])->firstOrFail();

        // Grab supervisor string if available
        $supervisor = isset($data['supervisor']) ? $data['supervisor'] : '';

        // Translate string to ID
        $supervisor_id = User::supervisorLabelToId($supervisor);

        // If label translator returns 0, translate ID to null for DB insertion
        if(empty($supervisor_id)) {
            $supervisor_id = null;
        }

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'image_id' => $image->id,
            'supervisor_user_id' => $supervisor_id,
            'position' => $data['position'],
            'password' => bcrypt($data['password']),
            'biography' => $data['biography'],
        ]);
    }
}
