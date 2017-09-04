<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public $variantDefinitions = [
        'profile' => '200',
        'mini' => '100'
    ];
}
