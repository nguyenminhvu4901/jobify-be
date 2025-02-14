<?php

namespace App\Repositories\UserEducation;

use App\Entities\UserEducation\UserEducation;

interface UserEducationRepository
{
    public function store(array $data);

    public function updateUserEducation(array $data, int|string $userEducationId);

    public function destroy(UserEducation $userEducation);
}
