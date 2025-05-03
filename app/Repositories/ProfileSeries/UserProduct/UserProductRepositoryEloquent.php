<?php

namespace App\Repositories\ProfileSeries\UserProduct;

use App\Entities\ProfileSeries\UserProduct\UserProduct;
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
