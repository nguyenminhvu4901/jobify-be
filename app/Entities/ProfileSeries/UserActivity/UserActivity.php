<?php

namespace App\Entities\ProfileSeries\UserActivity;

use App\Entities\ProfileSeries\UserActivity\Traits\UserActivityRelationship;
use App\Enums\RouteNames\Profile\UserActivityEnum;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * @property int $id
 * @property int|null $user_id
 * @property string $name Tên sản phẩm
 * @property string $position Vị trí tham gia
 * @property string $start_date
 * @property string|null $end_date
 * @property string|null $description Mô tả chi tiết
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Entities\ProfileSeries\UserActivityResource\UserActivityResource> $userActivityResources
 * @property-read int|null $user_activity_resources_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserActivity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserActivity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserActivity query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserActivity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserActivity whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserActivity whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserActivity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserActivity whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserActivity wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserActivity whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserActivity whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserActivity whereUserId($value)
 *
 * @mixin \Eloquent
 */
class UserActivity extends BaseModel implements Transformable
{
    use HasFactory;
    use TransformableTrait;
    use UserActivityRelationship;

    protected $table = UserActivityEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'user_id',
        'name',
        'position',
        'start_date',
        'end_date',
        'description',
    ];
}
