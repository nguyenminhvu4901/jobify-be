<?php

namespace App\Repositories\User;

/**
 * Interface UserRepository.
 */
interface UserRepository
{
    public function create(array $attributes);

    public function update(array $attributes, int|string $id);

    public function changePassword(array $attributes);

    public function findWithRelationships(
        int|string $id,
        array|string $relationship = [],
        array $relationshipCallbacksToFilter = []
    ): mixed;
}
