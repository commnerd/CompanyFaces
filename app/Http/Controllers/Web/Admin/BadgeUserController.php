<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Badge;
use App\User;

class BadgeUserController extends AdminController
{
    public function assign(User $user): Response {
        $badges = Badge::paginate(15);
        return response()->view('admin.badges.assign', compact('user', 'badges'));
    }

    public function save(User $user) {

    }
}
