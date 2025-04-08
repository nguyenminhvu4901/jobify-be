<?php

namespace App\Repositories\CompanySeries\CompanyBenefit;

use App\Entities\CompanySeries\CompanyBenefit\CompanyBenefit;
use App\Repositories\BaseRepository;

class CompanyBenefitRepositoryEloquent extends BaseRepository implements CompanyBenefitRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return CompanyBenefit::class;
    }

    public function checkExistByIdAndCompanyId($companyBenefitId, $companyId)
    {
        return $this->model
            ->whereById($companyBenefitId)
            ->whereByCompanyId($companyId)
            ->exists();
    }
}
