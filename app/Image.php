<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public $variantDefinitions = [
        'profile' => '200',
        'mini' => '100'
    ];

    public function variant(String $label): ImageVariant {
        $variant = ImageVariant::where('image_id', $this->id)->where('label', $label)->firstOrFail();
        return $variant;
    }

    public function variants(): BelongsTo {
        return $this->belongsTo(ImageVariants::class);
    }
}
