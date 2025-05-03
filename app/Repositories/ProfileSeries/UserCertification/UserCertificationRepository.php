<?php

namespace App\Repositories\ProfileSeries\UserCertification;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface UserCertificationRepository
{
    public function getWithRelationship(
        array|string $relationship = [],
        array $relationshipCallbacksToFilter = [],
    ): Collection;

    public function paginateWithRelationship(
        array|string $relationship = [],
        array $relationshipCallbacksToFilter = [],
                     $limit = null
    ): LengthAwarePaginator;

    public function findWithRelationships(
        int|string $id,
        array|string $relationship = [],
        array $relationshipCallbacksToFilter = []
    ): mixed;

    public function getByRelationshipUserSlug(
        $userSlug,
        array|string $relationship = [],
        array $relationshipCallbacksToFilter = [],
    ): mixed;

    public function findByRelationshipUserSlugAndColumnDetailId(
        $userSlug,
        $idColumn,
        array|string $relationship = [],
        array $relationshipCallbacksToFilter = [],
    ): mixed;

    public function storeDataWithTransaction(array $attributes);

    public function updateDataWithTransaction(array $attributes, string|int $userCertificationResourceId);

    public function destroyDataWithTransaction(int|string $userCertificationResourceId);
}
