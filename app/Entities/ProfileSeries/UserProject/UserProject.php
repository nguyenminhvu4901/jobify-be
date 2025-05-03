<?php

namespace App\Entities\ProfileSeries\UserProject;

use App\Entities\ProfileSeries\UserProject\Traits\UserProjectRelationship;
use App\Enums\RouteNames\Profile\UserProjectEnum;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * 
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $name Tên dự án
 * @property string $client Khách hàng
 * @property int $member Số thành viên tham gia
 * @property string $position Vị trí
 * @property string $mission Nhiệm vụ trong dự án
 * @property string|null $technology Công nghệ sử dụng
 * @property int $is_working Đang làm (0:false, 1:true)
 * @property string $start_date
 * @property string|null $end_date
 * @property string|null $description Mô tả chi tiết
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Entities\ProfileSeries\UserProjectResource\UserProjectResource> $userProjectResources
 * @property-read int|null $user_project_resources_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProject newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProject newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProject query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProject whereClient($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProject whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProject whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProject whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProject whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProject whereIsWorking($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProject whereMember($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProject whereMission($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProject whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProject wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProject whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProject whereTechnology($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProject whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProject whereUserId($value)
 * @mixin \Eloquent
 */
class UserProject extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, UserProjectRelationship;

    protected $table = UserProjectEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'user_id',
        'name',
        'client',
        'member',
        'position',
        'mission',
        'technology',
        'is_working',
        'start_date',
        'end_date',
        'description'
    ];
}
