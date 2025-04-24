<?php

namespace App\Entities\JobSeries\JobListingDetail\Traits;

use Illuminate\Database\Eloquent\Builder;

trait JobListingDetailScope
{
    /**
     * @param Builder $query
     * @param int $jobListingId
     * @return Builder
     */
    public function scopeWhereByJobListingId(Builder $query, int $jobListingId): Builder
    {
        return $query->where('job_listing_id', $jobListingId);
    }
}
