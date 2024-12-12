<?php

namespace App\Entities\UserCertification\Traits;

use App\Entities\UserCertificationResource\UserCertificationResource;
use App\Entities\UserCertificationType\UserCertificationType;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait UserCertificationRelationship
{
    /**
     * @return HasMany
     */
    public function userCertificationResource(): HasMany
    {
        return $this->hasMany(UserCertificationResource::class);
    }

    /**
     * @return BelongsTo
     */
    public function userCertificationType(): BelongsTo
    {
        return $this->belongsTo(UserCertificationType::class, 'type_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
