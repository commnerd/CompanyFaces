<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;

class ImageUploadService {
    public static function processImage(UploadedFile $image): bool {
        return \Storage::put($image->hashName(), file_get_contents($image->path()));
    }
}
