<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Controllers\Controller;
use App\Services\ImageUploadService;
use Validator;
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
     * Where to redirect users after login / registration.
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
     * @return Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, User::$registrationValidationRules);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data): User
    {
        if(!ImageUploadService::processImage($data['photo'])) {
            App::abort(500, "Something went wrong.");
        }
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'supervisor_user_id' => User::supervisorLabelToId($data['supervisor']),
            'position' => $data['position'],
            'password' => bcrypt($data['password']),
            'biography' => empty($data['biography']) ? '' : $data['biography'],
        ]);
    }
}
