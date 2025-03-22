<?php

namespace App\Repositories\BusinessSector;

use App\Entities\BusinessSector\BusinessSector;
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
