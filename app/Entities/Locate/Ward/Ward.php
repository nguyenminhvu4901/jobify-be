<?php

namespace App\Entities\Locate\Ward;

use App\Entities\Locate\Ward\Traits\WardRelationship;
use App\Entities\Locate\Ward\Traits\WardScope;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * 
 *
 * @property int $id
 * @property int $district_id
 * @property int $code
 * @property string $ward_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Entities\Locate\District\District|null $district
 * @property-read \App\Entities\Locate\Province\Province|null $province
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ward newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ward newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ward query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ward whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ward whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ward whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ward whereDistrict($districtId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ward whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ward whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ward whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ward whereWardName($value)
 * @mixin \Eloquent
 */
class Ward extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, WardRelationship, WardScope;

    protected $table = 'wards';

    public const FILLABLE_FIELDS = [
        'district_id',
        'code',
        'ward_name'
    ];
}
