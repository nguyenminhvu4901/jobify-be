<?php

namespace App\Entities\ProfileSeries\UserCourse\Traits;

use App\Entities\ProfileSeries\UserCourseResource\UserCourseResource;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait UserCourseRelationship
{
    public function userCourseResources(): HasMany
    {
        return $this->hasMany(UserCourseResource::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
