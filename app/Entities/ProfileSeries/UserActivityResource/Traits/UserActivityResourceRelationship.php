<?php

namespace App\Entities\ProfileSeries\UserActivityResource\Traits;

use App\Entities\DefaultSeries\DefaultContentType\DefaultContentType;
use App\Entities\ProfileSeries\UserActivity\UserActivity;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait UserActivityResourceRelationship
{
    /**
     * @return BelongsTo
     */
    public function contentType(): BelongsTo
    {
        return $this->belongsTo(DefaultContentType::class, 'content_type_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function userActivity(): BelongsTo
    {
        return $this->belongsTo(UserActivity::class, 'user_activity_id', 'id');
    }
}
