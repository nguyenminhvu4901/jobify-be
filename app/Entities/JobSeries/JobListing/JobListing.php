<?php

namespace App\Entities\JobSeries\JobListing;

use App\Entities\JobSeries\JobListing\Traits\JobListingRelationship;
use App\Models\BaseModel;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class JobListing extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, Sluggable, JobListingRelationship;

    protected $table = 'job_listings';

    public const FILLABLE_FIELDS = [
        'company_id',
        'title',
        'slug',
        'quantity_recruitment',
        'gender_id',
        'expiry_date',
        'description',
        'requirement',
        'benefit',
        'working_hour',
        'active_status_id',
        'approval_status_id',
        'job_salary_id',
        'job_type_id',
        'job_level_id',
        'job_experience',
        'view'
    ];

    /**
     * @return array[]
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
