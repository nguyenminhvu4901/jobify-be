<?php

namespace App\Entities\ProfileSeries\UserProfile\Traits;

use App\Entities\DefaultSeries\DefaultGender\DefaultGender;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait UserProfileRelationship
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function gender(): BelongsTo
    {
        return $this->belongsTo(DefaultGender::class, 'gender_id', 'id');
    }
}
