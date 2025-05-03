<?php

namespace App\Entities\ProfileSeries\UserCertification\Traits;

use App\Entities\ProfileSeries\UserCertificationResource\UserCertificationResource;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait UserCertificationRelationship
{
    public function userCertificationResources(): HasMany
    {
        return $this->hasMany(UserCertificationResource::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
