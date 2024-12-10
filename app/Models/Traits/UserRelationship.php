<?php

namespace App\Models\Traits;

use App\Entities\Company\Company;
use App\Entities\DefaultGender\DefaultGender;
use App\Entities\DefaultStatus\DefaultStatus;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait UserRelationship
{
    /**
     * @return BelongsTo
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(DefaultStatus::class, 'status_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function gender(): BelongsTo
    {
        return $this->belongsTo(DefaultGender::class, 'gender_id', 'id');
    }

    /**
     * @return HasOne
     */
    public function company(): HasOne
    {
        return $this->hasOne(Company::class);
    }
}
