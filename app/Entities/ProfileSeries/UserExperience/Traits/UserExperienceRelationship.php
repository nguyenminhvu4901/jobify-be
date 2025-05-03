<?php

namespace App\Entities\ProfileSeries\UserExperience\Traits;

use App\Entities\ProfileSeries\UserExperienceResource\UserExperienceResource;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait UserExperienceRelationship
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
    public function userExperienceResource(): HasMany
    {
        return $this->hasMany(UserExperienceResource::class);
    }
}
