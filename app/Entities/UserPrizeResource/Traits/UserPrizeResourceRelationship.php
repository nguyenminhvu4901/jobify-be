<?php

namespace App\Entities\UserPrizeResource\Traits;

use App\Entities\DefaultContentType\DefaultContentType;
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
