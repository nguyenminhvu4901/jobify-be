<?php

namespace App\Repositories\CompanySeries\Company;

use App\Entities\CompanySeries\Company\Company;

/**
 * Interface UserRepository.
 *
 * @package namespace App\Repositories;
 */
interface CompanyRepository
{
    public function create(array $attributes);

    public function syncOperationTypes(Company $company, array|null $operationTypes);

    public function syncBusinessSectors(Company $company, array|null $operationTypes);
}
