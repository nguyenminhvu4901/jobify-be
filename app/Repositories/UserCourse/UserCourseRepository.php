<?php

namespace App\Repositories\UserCourse;

use App\Entities\UserCourse\UserCourse;

interface UserCourseRepository
{
    public function create(array $attributes);

    public function updateUserCourse(array $attributes, string|int $userCourseId);

    public function destroy(UserCourse $userCourse);
}
