<?php

namespace App\Repositories\UserCertification;

interface UserCertificationRepository
{
    public function create(array $data);

    public function destroy($userCertification);
}
