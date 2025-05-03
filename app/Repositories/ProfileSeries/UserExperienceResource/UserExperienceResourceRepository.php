<?php

namespace App\Repositories\ProfileSeries\UserExperienceResource;

interface UserExperienceResourceRepository
{
    public function getByIds(array $userActivityResourceIds);
    public function storeDataWithTransaction(array $attributes);

    public function updateDataWithTransaction(array $attributes, string|int $userActivityResourceId);

    public function destroyDataWithTransaction(int|string $userActivityResourceId);
}
