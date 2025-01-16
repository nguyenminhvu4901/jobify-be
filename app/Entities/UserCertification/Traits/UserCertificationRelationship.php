<?php

namespace App\Entities\UserCertification\Traits;

use App\Entities\UserCertificationResource\UserCertificationResource;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait UserCertificationRelationship
{
    /**
     * @return HasMany
     */
    public function userCertificationResources(): HasMany
    {
        return $this->hasMany(UserCertificationResource::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
