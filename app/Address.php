<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /**
     * Conform to addressable relationship
     */
    public function addressable() {
        return $this->morphTo();
    }
}
