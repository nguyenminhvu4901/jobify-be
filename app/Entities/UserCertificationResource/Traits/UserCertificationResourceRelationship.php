<?php

namespace App\Entities\UserCertificationResource\Traits;

use App\Entities\DefaultContentType\DefaultContentType;
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

    /**
     * @return BelongsTo
     */
    public function contentType(): BelongsTo
    {
        return $this->belongsTo(DefaultContentType::class, 'content_type_id', 'id');
    }
}
