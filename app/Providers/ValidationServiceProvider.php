<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Intervention\Image\Facades\Image;
use App\User;

class ValidationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('required_if_users', function ($attribute, $value, $parameters, $validator) {
            dd(['count' => $users->count(), 'value' => $value]);
            return true;
        });
        Validator::extend('squared', function ($attribute, $value, $parameters, $validator) {
            $img = Image::make($value->path());
            return $img->width() === $img->height();
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
