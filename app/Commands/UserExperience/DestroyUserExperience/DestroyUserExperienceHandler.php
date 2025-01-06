<?php

namespace App\Commands\UserExperience\DestroyUserExperience;

use App\Repositories\UserExperience\UserExperienceRepository;
use App\Repositories\UserExperienceResource\UserExperienceResourceRepository;
use App\Services\UserExperience\UserExperienceService;

class DestroyUserExperienceHandler
{
    public function __construct(
        protected UserExperienceRepository $userExperienceRepository,
        protected UserExperienceResourceRepository $userExperienceResourceRepository,
        protected UserExperienceService $userExperienceService
    )
    {}

    public function handle(DestroyUserExperienceCommand $command)
    {
        $userExperience = $this->userExperienceRepository->findByRelationshipUserSlugAndColumnDetailId(
            $command->userSlug, $command->userExperienceId, 'userExperienceResource'
        );

        if(!empty($userExperience)){

            $userExperienceResource = $userExperience->userExperienceResource;

            $userExperienceResource->map(function ($eachUserExperienceResource){
                $this->userExperienceService->processDeleteAttachment($eachUserExperienceResource);
                $this->userExperienceResourceRepository->destroy($eachUserExperienceResource);
            });

             return $this->userExperienceRepository->destroy($userExperience);
        }

        return null;
    }
}
