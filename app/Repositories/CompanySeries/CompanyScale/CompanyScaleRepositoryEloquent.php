<?php

namespace App\Repositories\CompanySeries\CompanyScale;

use App\Entities\CompanySeries\CompanyScale\CompanyScale;
use App\Repositories\BaseRepository;

class CompanyScaleRepositoryEloquent extends BaseRepository implements CompanyScaleRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return CompanyScale::class;
    }
}
