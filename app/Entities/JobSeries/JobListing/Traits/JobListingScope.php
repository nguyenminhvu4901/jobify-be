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
}
