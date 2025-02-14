<?php

namespace App\Repositories\UserCertificationResource;

use App\Entities\UserCertificationResource\UserCertificationResource;

interface UserCertificationResourceRepository
{
    public function destroy(UserCertificationResource $userCertificationResource);
}
