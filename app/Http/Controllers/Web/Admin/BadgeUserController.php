<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\BadgeUser;
use App\Badge;
use App\User;

class BadgeUserController extends AdminController
{
    public function assign(User $user): Response {
        $badges = Badge::paginate(15);
        $presentedBadges = [];
        $user->hasBadge($badges[0]);
        foreach($badges as $badge) {
            array_push($presentedBadges, $badge->id);
        }
        $presentedBadges = implode(',', $presentedBadges);
        return response()->view('admin.badges.assign', compact('user', 'badges', 'presentedBadges'));
    }

    public function save(User $user, Request $request): Response {
        BadgeUser::where('user_id', $user->id)
            ->whereIn('badge_id', explode(',', $request->input('presentedBadges')))
            ->delete();
        foreach(array_keys($request->input('badges') ?? []) as $badge) {
            BadgeUser::create([
                'user_id' => $user->id,
                'badge_id' => $badge,
            ]);
        }
        return response(null, 302)->header('Location', route('users.show', ['user'=>$user]));
    }
}
