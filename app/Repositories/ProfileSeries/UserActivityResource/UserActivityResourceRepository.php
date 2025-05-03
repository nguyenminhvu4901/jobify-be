<?php

namespace App\Repositories\ProfileSeries\UserActivityResource;

interface UserActivityResourceRepository
{
    public function getByIds(array $userActivityResourceIds);

    public function storeDataWithTransaction(array $attributes);

    public function updateDataWithTransaction(array $attributes, string|int $userActivityResourceId);

    public function destroyDataWithTransaction(int|string $userActivityResourceId);
}
