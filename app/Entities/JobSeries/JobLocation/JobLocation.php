<?php

namespace App\Entities\JobSeries\JobLocation;

use App\Entities\JobSeries\JobLocation\Traits\JobLocationTrait;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;
class JobLocation extends BaseModel implements Transformable
{
    use JobLocationTrait;

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
