<?php

namespace App\Entities\UserCourse\Traits;

use App\Entities\UserCourseResource\UserCourseResource;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait UserCourseRelationship
{
    /**
     * @return HasMany
     */
    public function userCourseRelationship(): HasMany
    {
        return $this->hasMany(UserCourseResource::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
