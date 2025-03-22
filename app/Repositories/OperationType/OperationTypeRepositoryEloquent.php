<?php

namespace App\Repositories\OperationType;

use App\Entities\OperationType\OperationType;
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
