<?php

namespace App\Services;

use Intervention\Image\ImageManager;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Image;
use \App\ImageVariant;

class ImageProcessingService {
    public static function processOriginal(UploadedFile $file): \App\Image {
        $filename = 'tmp' . DIRECTORY_SEPARATOR . $file->hashName();
        \Storage::disk('public')->put($filename, file_get_contents($file->path()));
        $image = new \App\Image();
        $image->name = $filename;
        $image->url = \Storage::url($filename);
        $image->path = \Storage::disk('public')->path($filename);
        $image->save();
        return $image;
    }

    public static function processImage(String $name, int $x, int $y, int $width_height): \App\Image {
        $imageManager = new ImageManager();
        $image = \App\Image::where('name', $name)->firstOrFail();
        $filename = 'original'.DIRECTORY_SEPARATOR.basename($image->name);
        if(!file_exists(\Storage::disk('public')->path('original'))) {
            mkdir(\Storage::disk('public')->path('original'));
        }
        $interventionImage = $imageManager->make($image->path)->crop($width_height, $width_height, $x, $y);
        $newPath = \Storage::disk('public')->path($filename);
        if($interventionImage->save($newPath)) {
            // unlink($image->path);
            $image->url = \Storage::url($filename);
            $image->path = $newPath;
            $image->save();

            ImageProcessingService::processVariants($image);
        }

        return $image;
    }

    public static function processVariants(\App\Image $image) {
        foreach($image->variantDefinitions as $label => $size) {
            if(!file_exists(\Storage::disk('public')->path($label))) {
                mkdir(\Storage::disk('public')->path($label));
            }
            ImageProcessingService::processVariant($image, $label, $size);
        }
    }

    public static function processVariant(\App\Image $image, String $label,  String $size) {
        $imageManager = new ImageManager();
        $fileRelativePath = $label . DIRECTORY_SEPARATOR . basename($image->name);
        $imageManager->make($image->path)->resize($size, $size)->save(\Storage::disk('public')->path($fileRelativePath), 100);
        $imageVariant = new ImageVariant;
        $imageVariant->image_id = $image->id;
        $imageVariant->label = $label;
        $imageVariant->url = \Storage::url($fileRelativePath);
        $imageVariant->path = \Storage::disk('public')->path($fileRelativePath);
        $imageVariant->save();
    }
}
