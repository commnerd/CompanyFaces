<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use \Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'superuser' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'superuser', 'password', 'position', 'biography',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The used for validating a user.
     *
     * @var array
     */
    public static $registrationValidationRules = [
        'name' => 'required|max:255',
        'email' => 'required|email|max:255|unique:users',
        'supervisor' => 'max:255',
        'position' => 'required|max:255',
        'password' => 'required|min:6|confirmed',
    ];

    /**
     * Get this user's company
     */
    public function company() {
        return $this->hasOne('App\Company');
    }

    /**
     * Get supervisor from string
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param  String $string Input to determine supervisor
     * @return User           User ID
     */
    public static function getUserFromString(String $string): User {
        $nameAndPosition = ['name' => $string];
        try {
            $nameAndPosition = User::parseNameAndPosition($string);
        }
        catch(\Exception $e) {
            // Do nothing
        }

        $usersQuery = User::where('name', 'like', '%'.$nameAndPosition['name'].'%');
        $users = $usersQuery->get();
        if(sizeof($users) > 1) {
            return $usersQuery->where('position', $nameAndPosition['position'])->first();
        }
        if(sizeof($users) < 1) {
            throw \Exception("User not found.");
        }
        return $users[0];
    }

    /**
     *  Parse name and position from string
     *
     * @param String $string String to parse
     * @return array         Isolated name and position elements
     */
    public static function parseNameAndPosition(String $string): array {
        if(!preg_match('/(.+)\s\((.+)\)/', $string, $match)) {
            return ['name' => $match[0]];
        }
        return [
            'name' => $match[1],
            'position' => $match[2]
        ];
    }

    /**
     * Transform ID to name and position string
     *
     * @param int $id Id to get name/position
     * @return String Name and position
     */
    public static function idToNameAndPosition(int $id): String {
        $user = User::findOrFail($id);
        return "$user->name ($user->position)";
    }
}
