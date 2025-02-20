<?php

namespace App\Repositories\UserPrizeResource;

use App\Entities\UserPrizeResource\UserPrizeResource;

interface UserPrizeResourceRepository
{
    public function store(array $attributes);

    public function updateUserPrizeResource(array $attributes, int|string $userPrizeResourceId);

    public function destroy(UserPrizeResource $userPrizeResource);
}
