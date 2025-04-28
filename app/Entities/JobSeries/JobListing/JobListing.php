<?php

namespace App\Entities\JobSeries\JobListing;

use App\Entities\JobSeries\JobListing\Traits\JobListingRelationship;
use App\Entities\JobSeries\JobListing\Traits\JobListingScope;
use App\Enums\RouteNames\JobSeries\JobListingEnum;
use App\Models\BaseModel;
use App\Traits\Scope\BaseScopeTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * 
 *
 * @property int $id
 * @property int|null $company_id
 * @property string $title
 * @property string $slug
 * @property int $quantity_recruitment Số lượng tuyển
 * @property int|null $gender_id
 * @property string $publish_date Ngày tuyển dụng
 * @property string $expiry_date Ngày hết hạn
 * @property int|null $active_status_id
 * @property int|null $job_visibility_status_id
 * @property int|null $min_age
 * @property int|null $max_age
 * @property int|null $job_age_range_id
 * @property int|null $job_education_level_id
 * @property int|null $job_type_id
 * @property int|null $job_level_id
 * @property int|null $job_experience_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Entities\CompanySeries\Company\Company|null $companies
 * @property-read \App\Entities\DefaultSeries\DefaultGender\DefaultGender|null $gender
 * @property-read \App\Entities\JobSeries\JobAgeRange\JobAgeRange|null $jobAgeRanges
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Entities\JobSeries\JobContact\JobContact> $jobContact
 * @property-read int|null $job_contact_count
 * @property-read \App\Entities\JobSeries\JobEducationLevel\JobEducationLevel|null $jobEducationLevels
 * @property-read \App\Entities\JobSeries\JobExperience\JobExperience|null $jobExperiences
 * @property-read \App\Entities\JobSeries\JobLevel\JobLevel|null $jobLevels
 * @property-read \App\Entities\JobSeries\JobListingDetail\JobListingDetail|null $jobListingDetail
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Entities\JobSeries\JobLocation\JobLocation> $jobLocation
 * @property-read int|null $job_location_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Entities\JobSeries\JobModerationStatus\JobModerationStatus> $jobModerationStatus
 * @property-read int|null $job_moderation_status_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Entities\JobSeries\JobModerationStatusLog\JobModerationStatusLog> $jobModerationStatusLog
 * @property-read int|null $job_moderation_status_log_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Entities\JobSeries\JobSalary\JobSalary> $jobSalaries
 * @property-read int|null $job_salaries_count
 * @property-read \App\Entities\JobSeries\JobType\JobType|null $jobTypes
 * @property-read \App\Entities\JobSeries\JobVisibilityStatus\JobVisibilityStatus|null $jobVisibilityStatus
 * @property-read \Kalnoy\Nestedset\Collection<int, \App\Entities\JobSeries\Position\Position> $positions
 * @property-read int|null $positions_count
 * @property-read \App\Entities\DefaultSeries\DefaultStatus\DefaultStatus|null $status
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobListing checkExistCompanyIdAndJobId(int $companyId, int $jobListingId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobListing findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobListing newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobListing newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobListing onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobListing query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobListing searchFullText(string $keyword, array $columns, string $mode = 'NATURAL LANGUAGE MODE')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobListing whereActiveStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobListing whereByCompanyId(int $companyId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobListing whereById($id)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobListing whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobListing whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobListing whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobListing whereExpiryDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobListing whereGenderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobListing whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobListing whereJobAgeRangeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobListing whereJobEducationLevelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobListing whereJobExperienceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobListing whereJobLevelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobListing whereJobTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobListing whereJobVisibilityStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobListing whereMaxAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobListing whereMinAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobListing wherePublishDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobListing whereQuantityRecruitment($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobListing whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobListing whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobListing whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobListing withRelationships(array|string|null $relationships)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobListing withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobListing withUniqueSlugConstraints(\Illuminate\Database\Eloquent\Model $model, string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobListing withoutTrashed()
 * @mixin \Eloquent
 */
class JobListing extends BaseModel implements Transformable
{
    use TransformableTrait,
        HasFactory,
        Sluggable,
        JobListingRelationship,
//        Searchable,
        SoftDeletes,
        JobListingScope,
        BaseScopeTrait,
        SoftDeletes;

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

    public function toSearchableArray(): array
    {
        $array = $this->toArray();

        $array['id'] = $this->id;
        $array['title'] = $this->title;
        return $array;
    }
}
