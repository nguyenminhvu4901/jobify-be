<?php

namespace App\Entities\JobSeries\JobListing\Traits;

use Illuminate\Database\Eloquent\Builder;

trait JobListingScope
{
    /**
     * @param Builder $query
     * @param int $companyId
     * @return Builder
     */
    public function scopeWhereByCompanyId(Builder $query, int $companyId): Builder
    {
        return $query->where('company_id', $companyId);
    }

    /**
     * @param Builder $query
     * @param int $companyId
     * @param int $jobListingId
     * @return bool
     */
    public function scopeCheckExistCompanyIdAndJobId(
        Builder $query, int $companyId, int $jobListingId
    ): bool
    {
        return $query->where('company_id', $companyId)
            ->where('id', $jobListingId)
            ->exists();
    }
}
