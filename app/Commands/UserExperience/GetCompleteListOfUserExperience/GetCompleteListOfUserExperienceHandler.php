<?php

namespace App\Commands\UserExperience\GetCompleteListOfUserExperience;

use App\Repositories\UserExperience\UserExperienceRepository;

class GetCompleteListOfUserExperienceHandler
{
    public function __construct(
        protected UserExperienceRepository $userExperienceRepository
    )
    {
    }

    public function handle(GetCompleteListOfUserExperienceCommand $command)
    {
        return $this->userExperienceRepository->getWithRelationship(
            ['userExperienceResource', 'user']
        );
    }
}
