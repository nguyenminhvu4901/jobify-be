<?php

namespace App\Entities\ProfileSeries\UserCourseResource\Traits;

use App\Entities\DefaultSeries\DefaultContentType\DefaultContentType;
use App\Entities\ProfileSeries\UserCourse\UserCourse;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait UserCourseResourceRelationship
{
    public function userCourses(): BelongsTo
    {
        return $this->belongsTo(UserCourse::class, 'user_course_id', 'id');
    }

    public function contentType(): BelongsTo
    {
        return $this->belongsTo(DefaultContentType::class, 'content_type_id', 'id');
    }
}
