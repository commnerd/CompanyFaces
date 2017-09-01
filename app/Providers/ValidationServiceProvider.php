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
        Validator::extend('squared', function ($attribute, $value, $parameters, $validator) {
            $img = Image::make($value->path());
            return $img->width() === $img->height();
        });

        Validator::extend('stored_image', function($attribute, $value, $parameters, $validator) {
            $allowedMimeTypes = ['image/jpeg','image/gif','image/png','image/bmp','image/svg+xml'];
            $contentType = mime_content_type(\Storage::disk('public')->path($value));

            if(in_array($contentType, $allowedMimeTypes) ){
                return true;
            }

            return false;
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
