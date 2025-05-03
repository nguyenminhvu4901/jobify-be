<?php

namespace App\Entities\ProfileSeries\UserProfile\Traits;

use App\Entities\DefaultSeries\DefaultGender\DefaultGender;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait UserProfileRelationship
{
    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function gender(): BelongsTo
    {
        return $this->belongsTo(DefaultGender::class, 'gender_id', 'id');
    }
}
