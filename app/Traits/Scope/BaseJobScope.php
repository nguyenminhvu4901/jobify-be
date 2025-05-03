<?php

namespace App\Traits\Scope;

use Illuminate\Database\Eloquent\Builder;

trait BaseJobScope
{
    public function scopeWhereByJobListingId(Builder $query, ?int $jobListingId): Builder
    {
        return $query->where('job_listing_id', $jobListingId);
    }
}
