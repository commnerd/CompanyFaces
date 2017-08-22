<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->supervisor_user_id = null;
        $user->image_id = 1;
        $user->superuser = true;
        $user->name = 'Michael Miller';
        $user->position = 'Application Creator';
        $user->email = 'commnerd@gmail.com';
        $user->password = bcrypt('test');
        $user->biography = 'Not now';
        $user->save();
    }
}
