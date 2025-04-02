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
        if(!empty($companyId)){
            return $query->where('company_id', $companyId);
        }

        return $query;
    }
}
