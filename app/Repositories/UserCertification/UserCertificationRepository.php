<?php

namespace App\Repositories\UserCertification;

interface UserCertificationRepository
{
    public function create(array $data);

    public function updateUserCertification(array $attributes, int $userCertificationId);

    public function destroy($userCertification);
}
