<?php

use App\Services\ImageProcessingService;
use Illuminate\Database\Seeder;
use App\Image;

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
        $image->name = '41f0db63b809d640d948b202f580f780.jpeg';
        $image->url = '/storage/tmp/41f0db63b809d640d948b202f580f780.jpeg';
        $image->path = storage_path().DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'tmp'.DIRECTORY_SEPARATOR.'41f0db63b809d640d948b202f580f780.jpeg';
        $image->save();

        ImageProcessingService::processImage($image->path, 0, 0, 200);
    }
}
