<?php

namespace App\Entities\ProfileSeries\UserPrizeResource\Traits;

use App\Entities\DefaultSeries\DefaultContentType\DefaultContentType;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait UserPrizeResourceRelationship
{
    /**
     * @return BelongsTo
     */
    public function contentType(): BelongsTo
    {
        return $this->belongsTo(DefaultContentType::class, 'content_type_id', 'id');
    }
}
