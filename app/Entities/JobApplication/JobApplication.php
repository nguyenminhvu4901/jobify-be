<?php

namespace App\Entities\JobApplication;

use App\Entities\JobApplication\Traits\JobApplicationRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class JobApplication extends Model implements Transformable
{
    use TransformableTrait, HasFactory, JobApplicationRelationship;

    protected $table = 'job_applications';

    protected $fillable = [
        'user_id',
        'job_listing_id',
        'application_status_id',
        'applied_at',
        'cover_letter',
        'rejection_reason',
        'hired_at'
    ];
}
