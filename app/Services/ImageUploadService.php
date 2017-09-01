<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use App\Image;

class ImageUploadService {
    public static function processImage(UploadedFile $file): Image {
        \Storage::disk('public')->put($file->hashName(), file_get_contents($file->path()));
        $image = new Image();
        $image->name = $file->hashName();
        $image->path = \Storage::url($file->hashName());
        $image->save();
        return $image;
    }
}
