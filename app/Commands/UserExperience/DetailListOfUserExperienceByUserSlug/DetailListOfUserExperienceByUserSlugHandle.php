<?php

namespace App\Commands\UserExperience\DetailListOfUserExperienceByUserSlug;

use App\Repositories\UserExperience\UserExperienceRepository;

class DetailListOfUserExperienceByUserSlugHandle
{
    public function __construct(
        protected UserExperienceRepository $userExperienceRepository
    )
    {
    }

    public function handle(DetailListOfUserExperienceByUserSlugCommand $command)
    {
        return $this->userExperienceRepository->findByRelationshipUserSlug(
            $command->userSlug,
            ['userExperienceResource', 'user']
        );
    }
}
