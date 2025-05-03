<?php

namespace App\Entities\CompanySeries\CompanyBranch\Traits;

use Illuminate\Database\Eloquent\Builder;

trait CompanyBranchScope
{
    /**
     * @param Builder $query
     * @param $companyId
     * @return Builder
     */
    public function scopeWhereByCompanyId(Builder $query, $companyId): Builder
    {
        return $query->when(!empty($companyId), fn($q) => $q->where('company_id', $companyId));
    }
}
