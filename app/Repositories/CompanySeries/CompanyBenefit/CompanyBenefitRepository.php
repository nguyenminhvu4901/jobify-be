<?php

namespace App\Repositories\CompanySeries\CompanyBenefit;

interface CompanyBenefitRepository
{
    public function checkExistByIdAndCompanyId($companyBenefitId, $companyId);
}
