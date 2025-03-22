<?php

namespace App\Entities\ProfileSeries\UserActivity\Traits;

use App\Entities\ProfileSeries\UserActivityResource\UserActivityResource;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait UserActivityRelationship
{
    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function userActivityResources(): HasMany
    {
        return $this->hasMany(UserActivityResource::class);
    }
}
