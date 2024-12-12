<?php

namespace App\Entities\UserCertification\Traits;

use App\Entities\UserCertificationResource\UserCertificationResource;
use App\Entities\UserCertificationType\UserCertificationType;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait UserCertificationRelationship
{
    /**
     * @return HasOne
     */
    public function userCertificationResource(): HasOne
    {
        return $this->hasOne(UserCertificationResource::class);
    }

    /**
     * @return BelongsTo
     */
    public function userCertificationType(): BelongsTo
    {
        return $this->belongsTo(UserCertificationType::class, 'type_id', 'id');
    }
}
