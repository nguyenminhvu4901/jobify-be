<?php

namespace App\Entities\CompanySeries\Company\Traits;

use Illuminate\Database\Eloquent\Builder;

trait CompanyScope
{
    /**
     * @param Builder $query
     * @param $userId
     * @return Builder
     */
    public function scopeWhereUserId(Builder $query, $userId): Builder
    {
        if(!empty($userId)){
            return $query->where('user_id', $userId);
        }

        return $query;
    }

    /**
     * @param Builder $query
     * @param $companyBranchId
     * @return Builder
     */
    public function scopeWhereCompanyBranchId(Builder $query, $companyBranchId): Builder
    {
        if(!empty($companyBranchId)){

            return $query->whereHas('companyBranches',
                fn($q) => $q->where('id', $companyBranchId)
            );
        }

        return $query;
    }

    /**
     * @param Builder $query
     * @param $companyBenefitId
     * @return Builder
     */
    public function scopeWhereCompanyBenefitId(Builder $query, $companyBenefitId): Builder
    {
        if(!empty($companyBenefitId)){

            return $query->whereHas('companyBenefits',
                fn($q) => $q->where('id', $companyBenefitId)
            );
        }

        return $query;
    }
}
