<?php

namespace App\Commands\UserExperience\DetailListOfUserExperience;

use App\Repositories\UserExperience\UserExperienceRepository;

class DetailListOfUserExperienceHandle
{
    public function __construct(
        protected UserExperienceRepository $userExperienceRepository
    )
    {
    }

    public function handle(DetailListOfUserExperienceCommand $command)
    {
        return $this->userExperienceRepository->find($command->userExperienceId);
    }
}
