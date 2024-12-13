<?php

namespace App\Entities\JobListing\Traits;

use App\Entities\ApprovalStatus\ApprovalStatus;
use App\Entities\Company\Company;
use App\Entities\DefaultGender\DefaultGender;
use App\Entities\DefaultStatus\DefaultStatus;
use App\Entities\JobContact\JobContact;
use App\Entities\JobExperience\JobExperience;
use App\Entities\JobLevel\JobLevel;
use App\Entities\JobLocation\JobLocation;
use App\Entities\JobPosition\JobPosition;
use App\Entities\JobSalary\JobSalary;
use App\Entities\JobType\JobType;
use App\Entities\Position\Position;
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
     * @return BelongsTo
     */
    public function jobSalaries(): BelongsTo
    {
        return $this->belongsTo(JobSalary::class, 'job_salary_id', 'id');
    }

    /**
     * @return BelongsToMany
     */
    public function positions(): BelongsToMany
    {
        return $this->belongsToMany(Position::class, JobPosition::class);
    }

    /**
     * @return HasOne
     */
    public function jobContact(): HasOne
    {
        return $this->hasOne(JobContact::class);
    }

    /**
     * @return BelongsTo
     */
    public function gender()
    {
        return $this->belongsTo(DefaultGender::class, 'gender_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(DefaultStatus::class, 'active_status_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function approvalStatus()
    {
        return $this->belongsTo(ApprovalStatus::class, 'approval_status_id', 'id');
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
}
