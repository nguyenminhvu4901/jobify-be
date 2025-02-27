<?php

namespace App\Repositories\UserCourse;

use Illuminate\Database\Eloquent\Collection;

interface UserCourseRepository
{
    public function getWithRelationship(array|string $relationship = []): Collection;

    public function findWithRelationships(
        int|string $id,
        array|string $relationship = [],
        array $relationshipCallbacksToFilter = []
    ): mixed;

    public function getByRelationshipUserSlug($userSlug, array|string $relationship = []): mixed;

    public function storeDataWithTransaction(array $attributes);

    public function updateDataWithTransaction(array $attributes, int $userCourseId);

    public function destroyDataWithTransaction(int|string $userCourseId);
}
