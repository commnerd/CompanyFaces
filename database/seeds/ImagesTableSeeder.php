<?php

use App\Services\ImageProcessingService;
use Illuminate\Database\Seeder;
use \App\Image;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $image = new Image();
        $image->name = 'tmp'.DIRECTORY_SEPARATOR.'aaFDGJp072TRYxlkeW97kafsIUpys4cGjG2cxINA.jpeg';
        $image->url = \Storage::url($image->name);
        $image->path = \Storage::disk('public')->path($image->name);
        $image->save();

        ImageProcessingService::processImage($image->name, 105, 10, 50);

        $image = new Image();
        $image->name = 'tmp'.DIRECTORY_SEPARATOR.'1st-place-ribbon.png';
        $image->url = \Storage::url($image->name);
        $image->path = \Storage::disk('public')->path($image->name);
        $image->save();

        ImageProcessingService::processImage($image->name, 0, 0, 250);
    }
}
