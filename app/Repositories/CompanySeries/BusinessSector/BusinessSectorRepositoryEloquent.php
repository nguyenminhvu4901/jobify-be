<?php

namespace App\Repositories\CompanySeries\BusinessSector;

use App\Entities\CompanySeries\BusinessSector\BusinessSector;
use App\Repositories\BaseRepository;

class BusinessSectorRepositoryEloquent extends BaseRepository implements BusinessSectorRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return BusinessSector::class;
    }
}
