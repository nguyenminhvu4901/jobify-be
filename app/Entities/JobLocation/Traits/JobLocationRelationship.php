<?php

namespace App\Entities\JobLocation\Traits;

use App\Entities\District\District;
use App\Entities\Province\Province;
use App\Entities\Ward\Ward;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait JobLocationRelationship
{
    /**
     * @return BelongsTo
     */
    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'province_id', 'id')->withDefault();
    }

    /**
     * @return BelongsTo
     */
    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class, 'district_id', 'id')->withDefault();
    }

    /**
     * @return BelongsTo
     */
    public function ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class, 'ward_id', 'id')->withDefault();
    }
}
