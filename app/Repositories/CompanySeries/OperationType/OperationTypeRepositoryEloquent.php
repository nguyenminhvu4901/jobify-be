<?php

namespace App\Repositories\CompanySeries\OperationType;

use App\Entities\CompanySeries\OperationType\OperationType;
use App\Repositories\BaseRepository;

class OperationTypeRepositoryEloquent extends BaseRepository implements OperationTypeRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return OperationType::class;
    }
}
