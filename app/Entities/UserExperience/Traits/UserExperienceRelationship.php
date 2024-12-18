<?php

namespace App\Entities\UserExperience\Traits;

use App\Entities\DefaultContentType\DefaultContentType;
use App\Entities\UserExperienceResource\UserExperienceResource;
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

    public function contentType(): BelongsTo
    {
        return $this->belongsTo(DefaultContentType::class, 'content_type_id', 'id');
    }
}
