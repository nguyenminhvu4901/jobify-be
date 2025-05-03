<?php

namespace App\Repositories\ProfileSeries\UserProductResource;

interface UserProductResourceRepository
{
    public function getByIds(array $userActivityResourceIds);

    public function storeDataWithTransaction(array $attributes);

    public function updateDataWithTransaction(array $attributes, string|int $userProductResourceId);

    public function destroyDataWithTransaction(int|string $userProductResourceId);
}
