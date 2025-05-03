<?php

namespace App\Entities\ProfileSeries\UserExperience;

use App\Entities\ProfileSeries\UserExperience\Traits\UserExperienceRelationship;
use App\Entities\ProfileSeries\UserExperience\Traits\UserExperienceScope;
use App\Enums\RouteNames\Profile\UserExperienceEnum;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * @property int $id
 * @property int|null $user_id
 * @property string $name Tên công ty
 * @property string $position Tên chức vụ
 * @property int $is_working Đang làm việc tại đây (0:false, 1:true)
 * @property string $start_date Ngày bắt đầu
 * @property string|null $end_date Ngày kết thúc
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Entities\ProfileSeries\UserExperienceResource\UserExperienceResource> $userExperienceResource
 * @property-read int|null $user_experience_resource_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserExperience newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserExperience newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserExperience query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserExperience whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserExperience whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserExperience whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserExperience whereIsWorking($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserExperience whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserExperience wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserExperience whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserExperience whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserExperience whereUserId($value)
 *
 * @mixin \Eloquent
 */
class UserExperience extends BaseModel implements Transformable
{
    use HasFactory;
    use TransformableTrait;
    use UserExperienceRelationship;
    use UserExperienceScope;

    protected $table = UserExperienceEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'user_id',
        'name',
        'position',
        'is_working',
        'start_date',
        'end_date',
    ];
}
