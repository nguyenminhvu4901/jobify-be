<?php

namespace App\Entities\JobSeries\JobApplication;

use App\Entities\JobSeries\JobApplication\Traits\JobApplicationRelationship;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class JobApplication extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, JobApplicationRelationship;

    protected $table = 'job_applications';

    public const FILLABLE_FIELDS = [
        'user_id',
        'job_listing_id',
        'application_status_id',
        'applied_at',
        'cover_letter',
        'rejection_reason',
        'hired_at'
    ];
}
