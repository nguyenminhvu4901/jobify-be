<?php

namespace App\Entities\JobApplicationSeries\JobApplication\Traits;

use App\Entities\JobApplicationSeries\ApplicationCV\ApplicationCV;
use App\Entities\JobApplicationSeries\ApplicationStatus\ApplicationStatus;
use App\Entities\JobApplicationSeries\JobApplicationStatus\JobApplicationStatus;
use App\Entities\JobSeries\JobListing\JobListing;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait JobApplicationRelationship
{
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function jobListings(): BelongsTo
    {
        return $this->belongsTo(JobListing::class, 'job_listing_id', 'id');
    }

    public function applicationCV(): HasOne
    {
        return $this->hasOne(ApplicationCV::class);

    }

    public function applicationStatuses(): BelongsToMany
    {
        return $this->belongsToMany(
            ApplicationStatus::class,
            JobApplicationStatus::class
        )->withPivot(['reject_reason', 'hired_at'])->withTimestamps();
    }

    public function jobApplicationStatus(): HasMany
    {
        return $this->hasMany(JobApplicationStatus::class);
    }
}
