<?php

namespace App\Entities\JobSeries\JobListing;

use App\DataTransferObjects\Searchable\JobSeries\JobListings\JobListingSearchableDTO;
use App\Entities\JobSeries\JobListing\Traits\JobListingTrait;
use App\Enums\RouteNames\JobSeries\JobListingEnum;
use App\Models\BaseModel;
use JeroenG\Explorer\Application\Explored;
use Prettus\Repository\Contracts\Transformable;
use Illuminate\Database\Eloquent\Builder;

class JobListing extends BaseModel implements Transformable, Explored
{
    use JobListingTrait;

    protected $table = JobListingEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'company_id',
        'title',
        'slug',
        'quantity_recruitment',
        'gender_id',

        'publish_date',
        'expiry_date',

        'active_status_id',
        'job_visibility_status_id',

        'job_type_id',
        'job_level_id',
        'job_experience_id',
        'job_age_range_id',
        'job_education_level_id',
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

    public function searchableAs(): string
    {
        return 'job_listings_index';
    }

    public function toSearchableArray(): array
    {
        return JobListingSearchableDTO::prepareSearchableToArray($this);
    }

    public function mappableAs(): array
    {
        return JobListingSearchableDTO::prepareMappableAs();
    }

    /**
     * Modify the query used to retrieve models when making all of the models searchable.
     */
    protected function makeAllSearchableUsing(Builder $query): Builder
    {
        return $query->with([
            'companies' => fn($q) => $q->with(
                'user', 'gender', 'status', 'companyScale', 'companyBranches',
                'companyWorkingDay', 'operationTypes', 'businessSectors', 'companyBenefits'
            ),
            'jobLocation' => fn($q) => $q->with(['province', 'district', 'ward']),
            'jobSalaries' => fn($q) => $q->with(['currency', 'jobSalaryType']),
            'positions',
            'jobContact',
            'gender',
            'status',
            'jobModerationStatus',
            'jobModerationStatusLog',
            'jobVisibilityStatus',
            'jobTypes',
            'jobLevels',
            'jobExperiences',
            'jobEducationLevels',
            'jobAgeRanges',
            'jobListingDetail'
        ]);
    }
}
