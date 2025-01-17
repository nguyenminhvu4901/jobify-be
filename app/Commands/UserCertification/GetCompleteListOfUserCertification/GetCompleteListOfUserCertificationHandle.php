<?php

namespace App\Commands\UserCertification\GetCompleteListOfUserCertification;

use App\Repositories\UserCertification\UserCertificationRepository;

class GetCompleteListOfUserCertificationHandle
{
    public function __construct(
        protected UserCertificationRepository $userCertificationRepository
    )
    {
    }

    public function handle(GetCompleteListOfUserCertificationCommand $command)
    {
        return $this->userCertificationRepository->getWithRelationship(
            ['userCertificationResources', 'user']
        );
    }
}
