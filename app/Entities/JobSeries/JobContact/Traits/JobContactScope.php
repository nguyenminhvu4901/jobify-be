<?php

namespace App\Entities\JobSeries\JobContact\Traits;

use Illuminate\Database\Eloquent\Builder;

trait JobContactScope
{
    /**
     * @param Builder $query
     * @param $jobListingId
     * @return Builder
     */
    public function scopeWhereByJobListingId(Builder $query, $jobListingId): Builder
    {
        return $query->where('job_listing_id', $jobListingId);
    }
}
