<?php

namespace App\Commands\UserEducation\GetDetailListOfUserEducation;

use App\Repositories\UserEducation\UserEducationRepository;

class GetDetailListOfUserEducationHandle
{
    public function __construct(
        protected UserEducationRepository $userEducationRepository
    )
    {
    }

    public function handle(GetDetailListOfUserEducationCommand $command)
    {
        return $this->userEducationRepository->find($command->userEducationId);
    }
}
