<?php

namespace App\Entities\ProfileSeries\UserPrize;

use App\Entities\ProfileSeries\UserPrize\Traits\UserPrizeRelationship;
use App\Enums\RouteNames\Profile\UserPrizeEnum;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * 
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $name Tên giải thưởng
 * @property string|null $organization Tổ chức
 * @property string $start_date
 * @property string|null $end_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Entities\ProfileSeries\UserPrizeResource\UserPrizeResource> $userPrizeResources
 * @property-read int|null $user_prize_resources_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPrize newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPrize newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPrize query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPrize whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPrize whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPrize whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPrize whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPrize whereOrganization($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPrize whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPrize whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPrize whereUserId($value)
 * @mixin \Eloquent
 */
class UserPrize extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, UserPrizeRelationship;

    protected $table = UserPrizeEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'user_id',
        'name',
        'organization',
        'start_date',
        'end_date'
    ];
}
