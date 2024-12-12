<?php

namespace App\Entities\UserCertificationType\Traits;

use App\Entities\UserCertification\UserCertification;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait UserCertificationTypeRelationship
{
    /**
     * @return HasOne
     */
    public function userCertification(): HasOne
    {
        return $this->hasOne(UserCertification::class);
    }
}
