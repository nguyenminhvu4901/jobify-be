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

    public function changePassword(array $data);
}
