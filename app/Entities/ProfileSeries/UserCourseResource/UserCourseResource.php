<?php

namespace App\Entities\ProfileSeries\UserCourseResource;

use App\Entities\ProfileSeries\UserCourseResource\Traits\UserCourseResourceRelationship;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * @property int $id
 * @property int|null $user_course_id
 * @property string $title Tiêu đề
 * @property string $path
 * @property string|null $description
 * @property int|null $content_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Entities\DefaultSeries\DefaultContentType\DefaultContentType|null $contentType
 * @property-read \App\Entities\ProfileSeries\UserCourse\UserCourse|null $userCourses
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCourseResource newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCourseResource newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCourseResource query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCourseResource whereContentTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCourseResource whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCourseResource whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCourseResource whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCourseResource wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCourseResource whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCourseResource whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCourseResource whereUserCourseId($value)
 *
 * @mixin \Eloquent
 */
class UserCourseResource extends BaseModel implements Transformable
{
    use HasFactory;
    use TransformableTrait;
    use UserCourseResourceRelationship;

    protected $table = 'user_course_resources';

    public const FILLABLE_FIELDS = [
        'user_course_id',
        'title',
        'path',
        'description',
        'content_type_id',
    ];
}
