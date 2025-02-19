<?php

namespace App\Repositories\UserProject;

use App\Entities\UserProject\UserProject;

interface UserProjectRepository
{
    public function store(array $attributes);

    public function updateUserProject(array $attributes, $userProjectId);

    public function destroy(UserProject $userProject);
}
