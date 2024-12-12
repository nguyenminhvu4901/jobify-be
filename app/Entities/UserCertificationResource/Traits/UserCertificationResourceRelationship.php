<?php

namespace App\Entities\UserCertificationResource\Traits;

use App\Entities\UserCertification\UserCertification;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait UserCertificationResourceRelationship
{
    /**
     * @return BelongsTo
     */
    public function userCertification(): BelongsTo
    {
        return $this->belongsTo(UserCertification::class, 'user_certification_id', 'id');
    }
}
