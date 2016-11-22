<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * Get the users that belong to this company
     */
    public function users() {
        return $this->hasMany('App\User');
    }

    /**
     * Get all associated addresses
     */
    public function addresses()
    {
        return $this->morphMany('App\Address', 'addressable');
    }
}
