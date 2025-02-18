<?php

namespace App\Repositories\UserCertification;

interface UserCertificationRepository
{
    public function create(array $attributes);

    public function updateUserCertification(array $attributes, int $userCertificationId);

    public function destroy($userCertification);
}
