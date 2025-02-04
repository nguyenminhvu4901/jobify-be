<?php

namespace App\Repositories\UserEducation;

interface UserEducationRepository
{
    public function store(array $data);

    public function destroy($userEducation);
}
