<?php

namespace App\Repositories\UserProduct;

use App\Entities\UserProduct\UserProduct;
use App\Repositories\BaseRepository;

class UserProductRepositoryEloquent extends BaseRepository implements UserProductRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return UserProduct::class;
    }
}
