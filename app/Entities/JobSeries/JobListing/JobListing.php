<?php

namespace App\Entities\JobSeries\JobListing;

use App\Entities\JobSeries\JobListing\Traits\JobListingRelationship;
use App\Enums\RouteNames\JobSeries\JobListingEnum;
use App\Models\BaseModel;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use JeroenG\Explorer\Application\Explored;
use Laravel\Scout\Searchable;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class JobListing extends BaseModel implements Transformable, Explored
{
    use TransformableTrait,
        HasFactory,
        Sluggable,
        JobListingRelationship,
        Searchable,
        SoftDeletes;

    protected $table = JobListingEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'company_id',
        'title',
        'slug',
        'quantity_recruitment',
        'gender_id',
        'expiry_date',
        'active_status_id',
        'approval_status_id',
        'job_salary_id',
        'job_type_id',
        'job_level_id',
        'job_experience_id',
        'job_age_range_id',
        'job_education_level_id',
        'view',
        'min_age',
        'max_age'
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

    public function mappableAs(): array
    {
        return [

        ];
    }
}
