<?php

namespace App\Entities\Locate\District;

use App\Entities\Locate\District\Traits\DistrictRelationship;
use App\Entities\Locate\District\Traits\DistrictScope;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * 
 *
 * @property int $id
 * @property int $province_id
 * @property int $code
 * @property string $district_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Entities\Locate\Province\Province|null $province
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Entities\Locate\Ward\Ward> $ward
 * @property-read int|null $ward_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|District newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|District newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|District query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|District whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|District whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|District whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|District whereDistrictName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|District whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|District whereProvinceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|District whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class District extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory,
        DistrictRelationship, DistrictScope;

    protected $table = 'districts';

    public const FILLABLE_FIELDS = [
        'province_id',
        'code',
        'district_name'
    ];
}
