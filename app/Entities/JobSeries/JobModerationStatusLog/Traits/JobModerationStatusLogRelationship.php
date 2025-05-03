<?php

namespace App\Entities\JobSeries\JobModerationStatusLog\Traits;

use App\Entities\JobSeries\JobListing\JobListing;
use App\Entities\JobSeries\JobModerationStatus\JobModerationStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait JobModerationStatusLogRelationship
{
    /**
     * @return BelongsTo
     */
    public function jobListings(): BelongsTo
    {
        return $this->belongsTo(JobListing::class, 'job_listing_id')->withDefault();
    }

    /**
     * @return BelongsTo
     */
    public function jobModerationStatuses(): BelongsTo
    {
        return $this->belongsTo(JobModerationStatus::class, 'job_moderation_status_id');
    }

    /**
     * @return BelongsTo
     */
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
