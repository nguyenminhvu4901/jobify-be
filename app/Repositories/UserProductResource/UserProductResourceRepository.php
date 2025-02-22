<?php

namespace App\Repositories\UserProductResource;

use App\Entities\UserProductResource\UserProductResource;

interface UserProductResourceRepository
{
    public function store(array $attributes);

    public function updateUserProductResource(array $attributes, $userProductResourceId);

    public function destroy(UserProductResource $userProductResource);
}
