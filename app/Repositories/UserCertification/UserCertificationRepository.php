<?php

namespace App\Repositories\UserCertification;

use App\Entities\UserCertification\UserCertification;

interface UserCertificationRepository
{
    public function create(array $attributes);

    public function updateUserCertification(array $attributes, int $userCertificationId);

    public function destroy(UserCertification $userCertification);
}
