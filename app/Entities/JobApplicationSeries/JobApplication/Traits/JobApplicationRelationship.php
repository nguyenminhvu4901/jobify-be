<?php

namespace App\Entities\JobApplicationSeries\JobApplication\Traits;

use App\Entities\JobApplicationSeries\ApplicationCV\ApplicationCV;
use App\Entities\JobApplicationSeries\ApplicationStatus\ApplicationStatus;
use App\Entities\JobSeries\JobListing\JobListing;
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
     * @return HasMany
     */
    public function applicationCV(): HasMany
    {
        return $this->hasMany(ApplicationCV::class);

    }
}
