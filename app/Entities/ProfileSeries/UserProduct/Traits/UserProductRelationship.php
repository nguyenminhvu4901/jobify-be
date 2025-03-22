<?php

namespace App\Entities\ProfileSeries\UserProduct\Traits;

use App\Entities\ProfileSeries\UserProductResource\UserProductResource;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait UserProductRelationship
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
    public function userProductResources(): HasMany
    {
        return $this->hasMany(UserProductResource::class);
    }
}
