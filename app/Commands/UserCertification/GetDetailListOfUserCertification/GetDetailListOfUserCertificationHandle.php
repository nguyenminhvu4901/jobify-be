<?php

namespace App\Commands\UserCertification\GetDetailListOfUserCertification;

use App\Repositories\UserCertification\UserCertificationRepository;

class GetDetailListOfUserCertificationHandle
{
    public function __construct(
        protected UserCertificationRepository $userCertificationRepository
    )
    {
    }

    public function handle(GetDetailListOfUserCertificationCommand $command)
    {
        return $this->userCertificationRepository->find($command->userCertificationId);
    }
}
