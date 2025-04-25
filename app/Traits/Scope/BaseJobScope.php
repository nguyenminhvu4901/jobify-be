<?php

namespace App\Traits\Scope;

use Illuminate\Database\Eloquent\Builder;

trait BaseJobScope {
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
