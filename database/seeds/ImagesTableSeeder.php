<?php

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
        $image->path = '/storage/41f0db63b809d640d948b202f580f780.jpeg';
        $image->save();
    }
}
