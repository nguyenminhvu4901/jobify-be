<?php

namespace App\Entities\JobSeries\JobLocation;

use App\Entities\JobSeries\JobLocation\Traits\JobLocationRelationship;
use App\Entities\JobSeries\JobLocation\Traits\JobLocationScope;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

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
