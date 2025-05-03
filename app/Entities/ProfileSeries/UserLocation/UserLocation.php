<?php

namespace App\Entities\ProfileSeries\UserLocation;

use App\Entities\ProfileSeries\UserLocation\Traits\UserLocationRelationship;
use App\Enums\RouteNames\Profile\UserLocationEnum;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * 
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $province_id Tỉnh, thành phố
 * @property int|null $district_id Quận, huyện
 * @property int|null $ward_id Phường, xã
 * @property string|null $address Địa chỉ
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Entities\Locate\District\District|null $district
 * @property-read \App\Entities\Locate\Province\Province|null $province
 * @property-read \App\Models\User|null $user
 * @property-read \App\Entities\Locate\Ward\Ward|null $ward
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLocation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLocation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLocation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLocation whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLocation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLocation whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLocation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLocation whereProvinceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLocation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLocation whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLocation whereWardId($value)
 * @mixin \Eloquent
 */
class UserLocation extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, UserLocationRelationship;

    protected $table = UserLocationEnum::TABLE->value;

    protected $with = ['province', 'district', 'ward'];

    public const FILLABLE_FIELDS = [
        'user_id',
        'province_id',
        'district_id',
        'ward_id',
        'address'
    ];
}
