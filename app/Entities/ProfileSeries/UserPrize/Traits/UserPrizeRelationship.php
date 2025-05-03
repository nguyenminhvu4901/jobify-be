<?php

namespace App\Entities\ProfileSeries\UserPrize\Traits;

use App\Entities\ProfileSeries\UserPrizeResource\UserPrizeResource;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait UserPrizeRelationship
{
    public function userPrizeResources(): HasMany
    {
        return $this->hasMany(UserPrizeResource::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
