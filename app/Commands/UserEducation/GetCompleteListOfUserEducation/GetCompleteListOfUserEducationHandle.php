<?php

namespace App\Commands\UserEducation\GetCompleteListOfUserEducation;

use App\Repositories\UserEducation\UserEducationRepository;

class GetCompleteListOfUserEducationHandle
{
    public function __construct(
        protected UserEducationRepository $userEducationRepository
    )
    {
    }

    public function handle(GetCompleteListOfUserEducationCommand $command)
    {
        return $this->userEducationRepository->getWithRelationship('user');
    }
}
