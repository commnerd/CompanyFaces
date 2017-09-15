<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use App\Image;
use App\User;

class Badge extends Model
{
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'stand_alone' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image_id', 'title', 'stand_alone', 'description'
    ];

    /**
     * The rules used for validating badge input.
     *
     * @param int $id Id to get validation rules for
     * @return array Rules array
     */
    public static function getValidationRules(string $ruleSet, int $id = 0): array {
        if($ruleSet === User::VALIDATION_UPDATE && ($id === 0)) {
            throw new \Exception('Something went wrong.');
        }
        $rules = [];
        $rules['photo'] = 'required|string|stored_image';
        $rules['title'] = 'required|max:255';
        $rules['description'] = 'required';

        return $rules;
    }

    /**
     * Get badge's photo
     *
     * @return BelongsTo Image
     */
    public function photo(): BelongsTo {
        return $this->belongsTo(Image::class, 'image_id');
    }

    /**
     * Get badges' users
     *
     * @return BelongsToMany Users
     */
    public function users(): BelongsToMany {
        return $this->belongsTo(User::class);
    }
}
