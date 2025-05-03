<?php

namespace App\Entities\JobSeries\JobListing\Traits;

use App\Entities\CompanySeries\Company\Company;
use App\Entities\DefaultSeries\DefaultGender\DefaultGender;
use App\Entities\DefaultSeries\DefaultStatus\DefaultStatus;
use App\Entities\JobSeries\JobAgeRange\JobAgeRange;
use App\Entities\JobSeries\JobContact\JobContact;
use App\Entities\JobSeries\JobEducationLevel\JobEducationLevel;
use App\Entities\JobSeries\JobExperience\JobExperience;
use App\Entities\JobSeries\JobLevel\JobLevel;
use App\Entities\JobSeries\JobListingDetail\JobListingDetail;
use App\Entities\JobSeries\JobLocation\JobLocation;
use App\Entities\JobSeries\JobModerationStatus\JobModerationStatus;
use App\Entities\JobSeries\JobModerationStatusLog\JobModerationStatusLog;
use App\Entities\JobSeries\JobPosition\JobPosition;
use App\Entities\JobSeries\JobSalary\JobSalary;
use App\Entities\JobSeries\JobType\JobType;
use App\Entities\JobSeries\JobVisibilityStatus\JobVisibilityStatus;
use App\Entities\JobSeries\Position\Position;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 *
 */
trait JobListingRelationship
{
    /**
     * @return BelongsTo
     */
    public function companies(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
    /**
     * @return HasMany
     */
    public function jobLocation(): HasMany
    {
        return $this->hasMany(JobLocation::class);
    }

    /**
     * @return HasMany
     */
    public function jobSalaries(): HasMany
    {
        return $this->hasMany(JobSalary::class, 'job_listing_id', 'id');
    }


    /**
     * @return BelongsToMany
     */
    public function positions(): BelongsToMany
    {
        return $this->belongsToMany(Position::class, JobPosition::class)
            ->withTimestamps()
            ->withPivot(['priority']);
    }

    /**
     * @return HasMany
     */
    public function jobContact(): HasMany
    {
        return $this->hasMany(JobContact::class);
    }

    /**
     * @return BelongsTo
     */
    public function gender(): BelongsTo
    {
        return $this->belongsTo(DefaultGender::class, 'gender_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(DefaultStatus::class, 'active_status_id', 'id');
    }

    /**
     * @return BelongsToMany
     */
    public function jobModerationStatus(): BelongsToMany
    {
        return $this->belongsToMany(
            JobModerationStatus::class, JobModerationStatusLog::class,
            'job_listing_id', 'job_moderation_status_id'
        )
//            ->withTimestamps()
        ->withPivot(['note', 'created_by']);
    }

    /**
     * @return HasMany
     */
    public function jobModerationStatusLog(): HasMany
    {
        return $this->hasMany(JobModerationStatusLog::class, 'job_listing_id');
    }

    /**
     * @return BelongsTo
     */
    public function jobVisibilityStatus(): BelongsTo
    {
        return $this->belongsTo(JobVisibilityStatus::class, 'job_visibility_status_id', 'id')
            ;
    }

    /**
     * @return BelongsTo
     */
    public function jobTypes(): BelongsTo
    {
        return $this->belongsTo(JobType::class, 'job_type_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function jobLevels(): BelongsTo
    {
        return $this->belongsTo(JobLevel::class, 'job_level_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function jobExperiences(): BelongsTo
    {
        return $this->belongsTo(JobExperience::class, 'job_experience_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function jobEducationLevels(): BelongsTo
    {
        return $this->belongsTo(JobEducationLevel::class, 'job_education_level_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function jobAgeRanges(): BelongsTo
    {
        return $this->belongsTo(JobAgeRange::class, 'job_age_range_id', 'id');
    }

    /**
     * @return HasOne
     */
    public function jobListingDetail(): HasOne
    {
        return $this->hasOne(JobListingDetail::class);
    }
}
