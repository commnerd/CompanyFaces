<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\BadgeUser;
use App\Badge;
use App\User;

class BadgeUserController extends AdminController
{
    /**
     * Present screen to assign badges to people
     * @param  User     $user The user to assign the badge
     * @return Response       Redirect or view depending on scenario
     */
    public function assign(User $user): Response {
        $badges = Badge::paginate(15);

        // If no badges to assign, redirect to badge creation page
        if($badges->count() === 0) {
            session()->flash('warning', 'No badges available to assign, please create one.');
            return response(null, 302)->header('Location', route('admin.badges.create'));
        }

        // Provide included badges for deletion on update
        $presentedBadges = [];
        $user->hasBadge($badges[0]);
        foreach($badges as $badge) {
            array_push($presentedBadges, $badge->id);
        }
        $presentedBadges = implode(',', $presentedBadges);

        // Provide view
        return response()->view('admin.badges.assign', compact('user', 'badges', 'presentedBadges'));
    }

    /**
     * Save the state of the presented badges
     * @param  User     $user    User whose badges are being updated
     * @param  Request  $request The request holding the badges
     * @return Response          Redirect for successful badge update
     */
    public function save(User $user, Request $request): Response {
        // Delete the presented badges for repopulation
        BadgeUser::where('user_id', $user->id)
            ->whereIn('badge_id', explode(',', $request->input('presentedBadges')))
            ->delete();

        // Repopulate selected badges
        foreach(array_keys($request->input('badges') ?? []) as $badge_id) {
            $badge = Badge::where('id', $badge_id)->firstOrFail();
            if($badge->stand_alone) {
                BadgeUser::where('badge_id', $badge->id)->delete();
            }
            BadgeUser::create([
                'user_id' => $user->id,
                'badge_id' => $badge->id,
            ]);
        }

        // Provide view
        session()->flash('success', 'Successfully saved badges for '.$user->name.'.');
        return response(null, 302)->header('Location', route('users.show', ['user'=>$user]));
    }
}
