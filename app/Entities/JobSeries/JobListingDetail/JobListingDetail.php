<?php

namespace App\Entities\JobSeries\JobListingDetail;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class JobListingDetail extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory;

    protected $table = 'job_listing_details';

    public const FILLABLE_FIELDS = [
        'job_listing_id',
        'description',
        'requirement',
        'income',
        'benefit',
        'working_hour'
    ];
}
