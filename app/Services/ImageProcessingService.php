<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Intervention\Image\Image;
use App\ImageVariant;

class ImageProcessingService {
    public static function processOriginal(UploadedFile $file): App\Image {
        $filename = 'tmp' . DIRECTORY_SEPARATOR . $file->hashName();
        \Storage::disk('public')->put($filename, file_get_contents($file->path()));
        $image = new App\Image;
        $image->name = $file->hashName();
        $image->url = \Storage::url($filename);
        $image->path = \Storage::path($filename);
        $image->save();
        return $image;
    }

    public static function processImage(String $url, int $x, int $y, int $width_height): App\Image {
        $image = new App\Image::where('url', $url)->firstOrFail();
        $filename = 'original'.DIRECTORY_SEPARATOR.$image->name;
        $interventionImage = Image::make($image->path)->crop($width_height, $width_height, $x, $y);
        $newPath = \Storage::path($filename);
        if($interventionImage->save($newPath)) {
            unlink($image->path);
            $image->url = \Storage::url($filename);
            $image->path = $newPath;
            $image->save();

            ImageProcessingService::processVariants($image);
        }

        return $image;
    }

    public static function processVariants(App\Image $image): null {
        foreach($image->variants as $label => $size) {
            ImageProcessingService::processVariant($image, $label, $size);
        }
    }

    public static function processVariant(App\Image $image, String $label,  String $size): null {
        $fileRelativePath = $label . DIRECTORY_SEPARATOR . $image->name;
        Image::make($image->path)->resize($size, $size)->save(\Storage::path($fileRelativePath), 100);
        $imageVariant = new ImageVariant;
        $imageVariant->image_id = $image->id;
        $imageVariant->label = $label;
        $imageVariant->url = \Storage::url($fileRelativePath);
        $imageVariant->path = \Storage::path($fileRelativePath);
        $imageVariant->save();
    }
}
