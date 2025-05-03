<?php

namespace App\Entities\ProfileSeries\UserCourse;

use App\Entities\ProfileSeries\UserCourse\Traits\UserCourseRelationship;
use App\Enums\RouteNames\Profile\UserCourseEnum;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * @property int $id
 * @property int|null $user_id
 * @property string $name Tên Khóa học
 * @property string|null $organization Tổ chức
 * @property string $start_date
 * @property string|null $end_date
 * @property string|null $description Mô tả chi tiết
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Entities\ProfileSeries\UserCourseResource\UserCourseResource> $userCourseResources
 * @property-read int|null $user_course_resources_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCourse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCourse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCourse query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCourse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCourse whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCourse whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCourse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCourse whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCourse whereOrganization($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCourse whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCourse whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCourse whereUserId($value)
 *
 * @mixin \Eloquent
 */
class UserCourse extends BaseModel implements Transformable
{
    use HasFactory;
    use TransformableTrait;
    use UserCourseRelationship;

    protected $table = UserCourseEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'user_id',
        'name',
        'organization',
        'start_date',
        'end_date',
        'description',
    ];
}
