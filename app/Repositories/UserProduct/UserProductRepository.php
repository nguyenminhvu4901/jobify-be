<?php

namespace App\Repositories\UserProduct;

use App\Entities\UserProduct\UserProduct;

interface UserProductRepository
{
    public function store(array $attributes);

    public function updateUserProduct(array $attributes, $userProductId);

    public function destroy(UserProduct $userProduct);
}
