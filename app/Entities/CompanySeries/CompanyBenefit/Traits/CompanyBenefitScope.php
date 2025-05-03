<?php

namespace App\Entities\CompanySeries\CompanyBenefit\Traits;

use Illuminate\Database\Eloquent\Builder;

trait CompanyBenefitScope
{
    public function scopeWhereByCompanyId(Builder $query, $companyId): Builder
    {
        if (! empty($companyId)) {
            return $query->where('company_id', $companyId);
        }

        return $query;
    }
}
