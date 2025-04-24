<?php

namespace App\Entities\JobSeries\JobLocation\Traits;

use Illuminate\Database\Eloquent\Builder;

trait JobLocationScope
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
