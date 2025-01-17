<?php

namespace App\Commands\UserCertification\GetDetailListOfUserCertificationByUserSlug;

use App\Repositories\UserCertification\UserCertificationRepository;

class GetDetailListOfUserCertificationByUserSlugHandle
{
    public function __construct(
        protected UserCertificationRepository $userCertificationRepository
    )
    {
    }

    public function handle(GetDetailListOfUserCertificationByUserSlugCommand $command)
    {
        return $this->userCertificationRepository->findByRelationshipUserSlug(
            $command->userSlug,
            ['userCertificationResources', 'user']
        );
    }
}
