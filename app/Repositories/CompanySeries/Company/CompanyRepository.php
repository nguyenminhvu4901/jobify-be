<?php

namespace App\Repositories\CompanySeries\Company;

use App\Entities\CompanySeries\Company\Company;

/**
 * Interface UserRepository.
 */
interface CompanyRepository
{
    public function create(array $attributes);

    public function syncOperationTypes(Company $company, ?array $operationTypes);

    public function syncBusinessSectors(Company $company, ?array $operationTypes);
}
