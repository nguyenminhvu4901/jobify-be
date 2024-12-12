<?php

namespace App\Entities\UserActivity\Traits;

use App\Entities\UserActivityResource\UserActivityResource;
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
    public function userActivityResource(): HasMany
    {
        return $this->hasMany(UserActivityResource::class);
    }
}
