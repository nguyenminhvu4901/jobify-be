<?php

namespace App\Repositories\ProfileSeries\UserCourseResource;

interface UserCourseResourceRepository
{
    public function getByIds(array $userActivityResourceIds);
    public function storeDataWithTransaction(array $attributes);

    public function updateDataWithTransaction(array $attributes, string|int $userCourseResourceId);

    public function destroyDataWithTransaction(int|string $userCourseResourceId);
}
