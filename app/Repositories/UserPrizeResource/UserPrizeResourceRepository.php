<?php

namespace App\Repositories\UserPrizeResource;

interface UserPrizeResourceRepository
{
    public function getByIds(array $userActivityResourceIds);
    public function storeDataWithTransaction(array $attributes);

    public function updateDataWithTransaction(array $attributes, string|int $userPrizeResourceId);

    public function destroyDataWithTransaction(int|string $userPrizeResourceId);
}
