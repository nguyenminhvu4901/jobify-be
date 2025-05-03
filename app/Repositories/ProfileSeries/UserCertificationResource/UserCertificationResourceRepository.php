<?php

namespace App\Repositories\ProfileSeries\UserCertificationResource;

interface UserCertificationResourceRepository
{
    public function getByIds(array $userCertificationResourceIds);
    public function storeDataWithTransaction(array $attributes);

    public function updateDataWithTransaction(array $attributes, string|int $userCertificationResourceId);

    public function destroyDataWithTransaction(int|string $userCertificationResourceId);
}
