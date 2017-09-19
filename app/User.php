<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;
use App\Badge;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Request for registration validation rule set
     *
     * @var string
     */
    const VALIDATION_REGISTER = 'register';

    /**
     * Request for update validation rule set
     *
     * @var string
     */
    const VALIDATION_UPDATE = 'update';

    /**
     * Request for admin creation validation rule set
     *
     * @var string
     */
    const VALIDATION_CREATE = 'create';

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
        'name', 'email', 'image_id', 'superuser', 'supervisor_user_id', 'password', 'position', 'biography',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * The rules used for validating user input.
     *
     * @param int $id Id to get validation rules for
     * @return array Rules array
     */
    public static function getValidationRules(string $ruleSet, int $id = 0, bool $passwordIsSet = true): array {
        if($ruleSet === User::VALIDATION_UPDATE && ($id === 0)) {
            throw new \Exception('Something went wrong.');
        }
        $rules = [];
        $rules['photo'] = 'required|string|stored_image';
        $rules['name'] = 'required|max:255';
        $rules['email'] = 'required|email|max:255|unique:users';
        if($ruleSet === User::VALIDATION_UPDATE) {
            $rules['email'] .= ',id,'.$id;
        }
        $rules['supervisor'] = 'sometimes|max:255';
        if($ruleSet === User::VALIDATION_UPDATE) {
            $rules['supervisor'] .= '|not_circular:id='.$id;
        }
        $rules['position'] = 'required|max:255';

        if($passwordIsSet) {
            $rules['password'] = 'required|min:6|confirmed';
        }

        return $rules;
    }

    /**
     * The image variant sizings
     *
     * @var array
     */
    public static $variants = [
        'profile' => '200',
        'background' => '100',
    ];

    /**
     * Get this user's company
     *
     * @return BelongsTo Company
     */
    public function company(): BelongsTo {
        return $this->hasOne(Company::class);
    }

    /**
     * Get user's photo
     *
     * @return BelongsTo Image
     */
    public function photo(): BelongsTo {
        return $this->belongsTo(Image::class, 'image_id');
    }

    /**
     * Get user's supervisor
     *
     * @return BelongsTo Supervisor
     */
    public function supervisor(): BelongsTo {
        return $this->belongsTo(User::class, 'supervisor_user_id');
    }

    /**
     * Get user's badges
     *
     * @return BelongsToMany Badges
     */
    public function badges(): BelongsToMany {
        return $this->belongsToMany(Badge::class, 'badge_users');
    }

    /**
     * Get user's reports
     *
     * @return HasMany Reports
     */
    public function reports(): HasMany {
        return $this->hasMany(User::class, 'supervisor_user_id');
    }

    /**
     * Supervisor attribute
     *
     * @param App\Badge Badge to check user assignment
     * @return bool Badge assigned
     */
    public function hasBadge(Badge $badge): bool {
        foreach($this->badges as $assignedBadge) {
            if($badge->id === $assignedBadge->id) {
                return true;
            }
        }
        return false;
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
     * @param  String $string                               Supervisor Label used to determine user
     * @return \Illuminate\Pagination\LengthAwarePaginator  Users
     */
    public static function getUsersFromSupervisorLabel(String $string): LengthAwarePaginator {
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
        else {
            $usersQuery = $usersQuery->orWhere('position', 'like', '%'.$nameAndPosition['name'].'%');
        }
        $users = $usersQuery->paginate(15);
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
        // Return early w/o label
        if(empty($label)) {
            return 0;
        }
        $users = User::getUsersFromSupervisorLabel($label);

        // Return early w/o matches
        if($users->count() < 1) {
            return 0;
        }

        // Return early if more than one match
        if($users->count() > 1) {
            App::abort(500, 'Something went wrong.');
        }

        // Return user ID
        return $users->first()->id;
    }

    /**
     * Format supervisor label
     *
     * @param User $user User to format
     * @return String Name and Position
     */
    public static function formatSupervisorLabel(User $user = null): String {
        if(empty($user)) {
            return '';
        }
        return "$user->name ($user->position)";
    }

    /**
     * Link subordinates to supervisor
     *
     * @param User $user User to bypass
     */
    public static function linkSubordinatesToSupervisor(User &$user) {
        $supervisorId = null;
        if(!empty($user->supervisor)) {
            $supervisorId = $user->supervisor->id;
        }
        foreach($user->reports as $report) {
            $report->supervisor_user_id = $supervisorId;
            $report->save();
        }
    }
}
