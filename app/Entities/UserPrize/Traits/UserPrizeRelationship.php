<?php

namespace App\Entities\UserPrize\Traits;

use App\Entities\UserPrizeResource\UserPrizeResource;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait UserPrizeRelationship
{
    /**
     * @return HasMany
     */
    public function userCourseRelationship(): HasMany
    {
        return $this->hasMany(UserPrizeResource::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
