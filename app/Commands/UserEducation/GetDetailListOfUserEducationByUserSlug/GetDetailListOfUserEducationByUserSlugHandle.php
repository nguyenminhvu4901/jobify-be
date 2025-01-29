<?php

namespace App\Commands\UserEducation\GetDetailListOfUserEducationByUserSlug;

use App\Repositories\UserEducation\UserEducationRepository;

class GetDetailListOfUserEducationByUserSlugHandle
{
    public function __construct(
        protected UserEducationRepository $userEducationRepository
    )
    {
    }

    public function handle(GetDetailListOfUserEducationByUserSlugCommand $command)
    {
        return $this->userEducationRepository->findByRelationshipUserSlug(
            $command->userSlug,
            'user'
        );
    }
}
