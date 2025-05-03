<?php

namespace App\Traits\Scope;

use Illuminate\Database\Eloquent\Builder;

trait BaseJobScope {
    /**
     * @param Builder $query
     * @param int|null $jobListingId
     * @return Builder
     */
    public function scopeWhereByJobListingId(Builder $query, int|null $jobListingId): Builder
    {
        return $query->where('job_listing_id', $jobListingId);
    }
}
