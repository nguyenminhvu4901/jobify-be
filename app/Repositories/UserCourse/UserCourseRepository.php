<?php

namespace App\Repositories\UserCourse;

interface UserCourseRepository
{
    public function create(array $attributes);

    public function updateUserCourse(array $attributes, string|int $userCourseId);
}
