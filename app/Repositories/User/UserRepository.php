<?php

namespace App\Repositories\User;

/**
 * Interface UserRepository.
 *
 * @package namespace App\Repositories;
 */
interface UserRepository
{
    public function search(array $params);

    public function create(array $data);

    public function find(int $id);

    public function update(array $data, int $id);
}
