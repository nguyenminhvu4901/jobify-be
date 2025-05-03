<?php

namespace App\Entities\Locate\District\Traits;

use App\Entities\Locate\Province\Province;
use App\Entities\Locate\Ward\Ward;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait DistrictRelationship
{
    /**
     * @return BelongsTo
     */
    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class)->withDefault();
    }

    /**
     * @return HasMany
     */
    public function ward(): HasMany
    {
        return $this->hasMany(Ward::class);
    }
}
