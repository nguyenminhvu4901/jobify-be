<?php

namespace App\Entities\JobSeries\JobSalary\Traits;

use Illuminate\Database\Eloquent\Builder;

trait JobSalaryScope
{
    public function scopeWhereFirstByJobListingId(Builder $query, int $jobListingId): Builder
    {
        return $query->whereHas('jobListing', function ($q) use ($jobListingId){
            return $q->where('id', $jobListingId);
        });
    }
}
