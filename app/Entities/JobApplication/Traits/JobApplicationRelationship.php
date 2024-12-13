<?php

namespace App\Entities\JobApplication\Traits;

use App\Entities\ApplicationCV\ApplicationCV;
use App\Entities\ApplicationStatus\ApplicationStatus;
use App\Entities\JobListing\JobListing;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait JobApplicationRelationship
{
    /**
     * @return BelongsTo
     */
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function jobListings(): BelongsTo
    {
        return $this->belongsTo(JobListing::class, 'job_listing_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function applicationStatus(): BelongsTo
    {
        return $this->belongsTo(ApplicationStatus::class, 'application_status_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function applicationCV(): HasMany
    {
        return $this->hasMany(ApplicationCV::class);

    }
}
