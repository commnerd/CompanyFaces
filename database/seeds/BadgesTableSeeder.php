<?php

use Illuminate\Database\Seeder;
use App\Badge;

class BadgesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $badge = new Badge();
        $badge->image_id = 2;
        $badge->title = '1st Place!';
        $badge->stand_alone = false;
        $badge->description = 'Not now';
        $badge->save();
    }
}
