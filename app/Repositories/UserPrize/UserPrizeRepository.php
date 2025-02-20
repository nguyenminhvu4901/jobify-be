<?php

namespace App\Repositories\UserPrize;

use App\Entities\UserPrize\UserPrize;

interface UserPrizeRepository
{
    public function store(array $attributes);

    public function updateUserPrize(array $attributes, int|string $userPrizeId);

    public function destroy(UserPrize $userPrize);
}
