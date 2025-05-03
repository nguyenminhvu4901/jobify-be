<?php

namespace App\Entities\ProfileSeries\UserCertification;

use App\Entities\ProfileSeries\UserCertification\Traits\UserCertificationRelationship;
use App\Enums\RouteNames\Profile\UserCertificationEnum;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * @property int $id
 * @property int|null $user_id
 * @property string $name Tên chứng chỉ
 * @property string|null $organization Tổ chức
 * @property int $is_no_expiration Không có ngày hết hạn (0:false, 1:true)
 * @property string $start_date
 * @property string|null $end_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Entities\ProfileSeries\UserCertificationResource\UserCertificationResource> $userCertificationResources
 * @property-read int|null $user_certification_resources_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCertification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCertification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCertification query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCertification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCertification whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCertification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCertification whereIsNoExpiration($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCertification whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCertification whereOrganization($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCertification whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCertification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCertification whereUserId($value)
 *
 * @mixin \Eloquent
 */
class UserCertification extends BaseModel implements Transformable
{
    use HasFactory;
    use TransformableTrait;
    use UserCertificationRelationship;

    protected $table = UserCertificationEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'user_id',
        'name',
        'organization',
        'is_no_expiration',
        'start_date',
        'end_date',
    ];
}
