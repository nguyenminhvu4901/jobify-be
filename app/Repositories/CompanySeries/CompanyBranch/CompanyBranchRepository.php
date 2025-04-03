<?php

namespace App\Repositories\CompanySeries\CompanyBranch;

/**
 * Interface UserRepository.
 *
 * @package namespace App\Repositories;
 */
interface CompanyBranchRepository
{
    public function create(array $attributes);

    public function checkExistByIdAndCompanyId($companyBranchId, $companyId);
}
