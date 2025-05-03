<?php

namespace App\Entities\ProfileSeries\UserEducation;

use App\Entities\ProfileSeries\UserEducation\Traits\UserEducationRelationship;
use App\Enums\RouteNames\Profile\UserEducationEnum;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * 
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $name Tên trường
 * @property string $major Ngành học
 * @property int $is_studying Đang học ở đây (0:false, 1:true)
 * @property string $start_date
 * @property string|null $end_date
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserEducation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserEducation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserEducation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserEducation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserEducation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserEducation whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserEducation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserEducation whereIsStudying($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserEducation whereMajor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserEducation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserEducation whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserEducation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserEducation whereUserId($value)
 * @mixin \Eloquent
 */
class UserEducation extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, UserEducationRelationship;

    protected $table = UserEducationEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'user_id',
        'name',
        'major',
        'is_studying',
        'start_date',
        'end_date',
        'description'
    ];
}
