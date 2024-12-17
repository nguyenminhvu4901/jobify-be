<?php

namespace App\Repositories\User;

/**
 * Interface UserRepository.
 *
 * @package namespace App\Repositories;
 */
interface UserRepository
{
    public function create(array $data);

    public function update(array $data, $userId);

    public function changePassword(array $data);
}
