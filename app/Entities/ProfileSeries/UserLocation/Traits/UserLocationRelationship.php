<?php

namespace App\Entities\ProfileSeries\UserLocation\Traits;

use App\Entities\Locate\District\District;
use App\Entities\Locate\Province\Province;
use App\Entities\Locate\Ward\Ward;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait UserLocationRelationship
{
    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

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
