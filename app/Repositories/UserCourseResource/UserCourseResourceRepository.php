<?php

namespace App\Repositories\UserCourseResource;

use App\Entities\UserCourseResource\UserCourseResource;

interface UserCourseResourceRepository
{
    public function store(array $attributes);

    public function updateUserCourseResource(
        array $attributes,
        int|string $userCourseResourceId,
    );

    public function destroy(UserCourseResource $userCourseResource);

    public function getListUserCourseResourceByIds(array $userCourseResourceId);
}
