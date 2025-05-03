<?php

namespace App\Entities\JobSeries\JobLocation;

use App\Entities\JobSeries\JobLocation\Traits\JobLocationRelationship;
use App\Entities\JobSeries\JobLocation\Traits\JobLocationScope;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * 
 *
 * @property int $id
 * @property int|null $job_listing_id
 * @property int|null $province_id
 * @property int|null $district_id
 * @property int|null $ward_id
 * @property string|null $branch_name
 * @property string|null $address
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Entities\Locate\District\District|null $district
 * @property-read \App\Entities\Locate\Province\Province|null $province
 * @property-read \App\Entities\Locate\Ward\Ward|null $ward
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobLocation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobLocation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobLocation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobLocation whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobLocation whereBranchName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobLocation whereByJobListingId(?int $jobListingId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobLocation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobLocation whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobLocation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobLocation whereJobListingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobLocation whereProvinceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobLocation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobLocation whereWardId($value)
 * @mixin \Eloquent
 */
class JobLocation extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, JobLocationRelationship, JobLocationScope;

    protected $table = 'job_locations';

    public const FILLABLE_FIELDS = [
        'job_listing_id',
        'province_id',
        'district_id',
        'ward_id',
        'branch_name',
        'address'
    ];
}
