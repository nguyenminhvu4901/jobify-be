<?php

namespace App\Entities\UserCourseResource\Traits;

use App\Entities\DefaultContentType\DefaultContentType;
use App\Entities\UserCourse\UserCourse;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait UserCourseResourceRelationship
{
    /**
     * @return BelongsTo
     */
    public function userCourses(): BelongsTo
    {
        return $this->belongsTo(UserCourse::class, 'user_course_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function contentType(): BelongsTo
    {
        return $this->belongsTo(DefaultContentType::class, 'content_type_id', 'id');
    }
}
