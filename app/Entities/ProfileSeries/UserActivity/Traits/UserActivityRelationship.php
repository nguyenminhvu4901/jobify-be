<?php

namespace App\Entities\ProfileSeries\UserActivity\Traits;

use App\Entities\ProfileSeries\UserActivityResource\UserActivityResource;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait UserActivityRelationship
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function userActivityResources(): HasMany
    {
        return $this->hasMany(UserActivityResource::class);
    }
}
