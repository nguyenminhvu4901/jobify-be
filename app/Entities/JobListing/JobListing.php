<?php

namespace App\Entities\JobListing;

use App\Entities\JobListing\Traits\JobListingRelationship;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class JobListing extends Model implements Transformable
{
    use TransformableTrait, HasFactory, Sluggable, JobListingRelationship;

    protected $table = 'job_listings';

    protected $fillable = [
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
