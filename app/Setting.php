<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * Casts for the model
     * @var array
     */
    protected $casts = [
        'enabled' => 'boolean'
    ];

    /**
     * Fillable fields for the model
     *
     * @var array
     */
    protected $fillable = [
        'enabled',
        'slug',
        'label',
    ];

    public static function show(string $slug): bool {
        return Setting::where('slug', $slug)->firstOrFail()->enabled;
    }
}
