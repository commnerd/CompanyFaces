<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['supervisorLabel'];

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
        'name', 'email', 'superuser', 'supervisor', 'password', 'position', 'biography',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'superuser',
    ];

    /**
     * The used for validating a user.
     *
     * @var array
     */
    public static $registrationValidationRules = [
        'photo' => 'required|image',
        'name' => 'required|max:255',
        'email' => 'required|email|max:255|unique:users',
        'supervisor' => 'max:255',
        'position' => 'required|max:255',
        'password' => 'required|min:6|confirmed',
    ];

    /**
     * Get this user's company
     *
     * @return HasOne Company
     */
    public function company(): HasOne {
        return $this->hasOne(Company::class);
    }

    /**
     * Get user's photo
     *
     * @return HasOne Image
     */
    public function photo(): HasOne {
        return $this->hasOne(Image::class, 'id');
    }

    /**
     * Get user's supervisor
     *
     * @return HasOne Supervisor
     */
    public function supervisor(): HasOne {
        return $this->hasOne(User::class, 'supervisor_user_id');
    }

    /**
     * Supervisor attribute
     *
     * @return String $supervisorLabel
     */
    public function getSupervisorLabelAttribute(): String {
        return User::formatSupervisorLabel($this);
    }

    /**
     * Get supervisor from string
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param  String $string                       Supervisor Label used to determine user
     * @return \Illuminate\Support\Collection       Users
     */
    public static function getUsersFromSupervisorLabel(String $string): Collection {
        $nameAndPosition = ['name' => $string];
        try {
            $nameAndPosition = User::parseSupervisorLabel($string);
        }
        catch(\Exception $e) {
            // Do nothing
        }

        $usersQuery = User::where('name', 'like', '%'.$nameAndPosition['name'].'%');
        if(isset($nameAndPosition['position'])) {
            $usersQuery = $usersQuery->where('position', $nameAndPosition['position']);
        }
        $users = $usersQuery->get();
        return $users;
    }

    /**
     *  Parse name and position from string
     *
     * @param String $string String to parse
     * @return array         Isolated name and position elements
     */
    public static function parseSupervisorLabel(String $string): array {
        if(!preg_match('/(.+)\s\((.+)\)/', $string, $match)) {
            return ['name' => $string];
        }
        return [
            'name' => $match[1],
            'position' => $match[2]
        ];
    }

    /**
     * Transform ID to supervisor label
     *
     * @param int $id User ID to transform into supervisor label
     * @return String Supervisor label
     */
    public static function idToSupervisorLabel(int $id): String {
        $user = User::findOrFail($id);
        return User::formatSupervisorLabel($user);
    }

    /**
     * Transform supervisor label to ID
     *
     * @param String $label Label for supervisor
     * @return int          ID of supervisor
     */
    public static function supervisorLabelToId(String $label): int {
        $users = User::getUsersFromSupervisorLabel($label);
        if($users->count() > 1) {
            App::abort(500, 'Something went wrong.');
        }
        return $users->first()->id;
    }

    /**
     * Format supervisor label
     *
     * @param User $user User to format
     * @return String Name and Position
     */
    public static function formatSupervisorLabel(User $user): String {
        return "$user->name ($user->position)";
    }
}
