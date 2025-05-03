<?php

namespace App\Entities\JobApplicationSeries\JobApplication\Traits;

use Illuminate\Database\Eloquent\Builder;

trait JobApplicationScope
{
    /**
     * @method static Builder whereUserIdAndJobListingId(int $userId, int $jobListingId)
     */
    public function scopeWhereUserIdAndJobListingId(Builder $query, int $userId, int $jobListingId): Builder
    {
        return $query->where('user_id', $userId)->where('job_listing_id', $jobListingId);
    }
}
