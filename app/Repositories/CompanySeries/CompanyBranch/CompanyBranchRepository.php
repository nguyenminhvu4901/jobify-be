<?php

namespace App\Repositories\CompanySeries\CompanyBranch;

/**
 * Interface UserRepository.
 */
interface CompanyBranchRepository
{
    public function create(array $attributes);

    public function checkExistByIdAndCompanyId($companyBranchId, $companyId);
}
