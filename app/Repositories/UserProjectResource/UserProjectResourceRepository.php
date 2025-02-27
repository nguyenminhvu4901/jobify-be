<?php

namespace App\Repositories\UserProjectResource;

interface UserProjectResourceRepository
{
    public function getByIds(array $userActivityResourceIds);
    public function storeDataWithTransaction(array $attributes);

    public function updateDataWithTransaction(array $attributes, string|int $userProjectResourceId);

    public function destroyDataWithTransaction(int|string $userProjectResourceId);
}
