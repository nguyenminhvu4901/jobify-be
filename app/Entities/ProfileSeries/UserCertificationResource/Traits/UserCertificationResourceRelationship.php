<?php

namespace App\Entities\ProfileSeries\UserCertificationResource\Traits;

use App\Entities\DefaultSeries\DefaultContentType\DefaultContentType;
use App\Entities\ProfileSeries\UserCertification\UserCertification;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait UserCertificationResourceRelationship
{
    public function userCertification(): BelongsTo
    {
        return $this->belongsTo(UserCertification::class, 'user_certification_id', 'id');
    }

    public function contentType(): BelongsTo
    {
        return $this->belongsTo(DefaultContentType::class, 'content_type_id', 'id');
    }
}
