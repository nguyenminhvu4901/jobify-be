<?php

namespace App\Repositories\UserActivity;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface UserActivityRepository
{
    public function getWithRelationship(
        array|string $relationship = [],
        array $relationshipCallbacksToFilter = [],
    ): Collection;

    public function findWithRelationships(
        int|string $id,
        array|string $relationship = [],
        array $relationshipCallbacksToFilter = [],
    ): mixed;

    public function getByRelationshipUserSlug(
        $userSlug,
        array|string $relationship = [],
        array $relationshipCallbacksToFilter = [],
    ): mixed;

    public function paginateWithRelationship(
        array|string $relationship = [],
        array $relationshipCallbacksToFilter = [],
        $limit = null
    ): LengthAwarePaginator;

    public function storeDataWithTransaction(array $attributes);

    public function updateDataWithTransaction(array $attributes, int $userActivityId);

    public function destroyDataWithTransaction(int|string $userActivityId);
}
