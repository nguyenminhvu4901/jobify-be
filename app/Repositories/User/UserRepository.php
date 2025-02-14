<?php

namespace App\Repositories\User;

/**
 * Interface UserRepository.
 *
 * @package namespace App\Repositories;
 */
interface UserRepository
{
    public function create(array $attributes);

    public function update(array $attributes, int|string $userId);

    public function changePassword(array $attributes);
}
