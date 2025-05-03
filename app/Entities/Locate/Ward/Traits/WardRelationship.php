<?php

namespace App\Entities\Locate\Ward\Traits;

use App\Entities\Locate\District\District;
use App\Entities\Locate\Province\Province;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait WardRelationship
{
    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'province_id', 'id')->withDefault();
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class, 'district_id', 'id')->withDefault();
    }
}
