<?php

namespace App\Commands\UserExperience\DestroyUserExperience;

use App\Repositories\UserExperience\UserExperienceRepository;
use App\Repositories\UserExperienceResource\UserExperienceResourceRepository;
use App\Services\AttachmentResource\AttachmentResourceService;

class DestroyUserExperienceHandler
{
    public function __construct(
        protected UserExperienceRepository $userExperienceRepository,
        protected UserExperienceResourceRepository $userExperienceResourceRepository,
        protected AttachmentResourceService $attachmentResourceService
    )
    {}

    /**
     * @param DestroyUserExperienceCommand $command
     * @return bool|null
     */
    public function handle(DestroyUserExperienceCommand $command): ?bool
    {
        $userExperience = $this->userExperienceRepository->findByRelationshipUserSlugAndColumnDetailId(
            $command->userSlug, $command->userExperienceId, 'userExperienceResource'
        );

        if(!empty($userExperience)){

            $userExperienceResource = $userExperience->userExperienceResource;

            if(!empty($userExperienceResource)){
                $userExperienceResource->map(function ($eachUserExperienceResource){
                    $this->attachmentResourceService->deleteFileAttachment($eachUserExperienceResource);
                    $this->userExperienceResourceRepository->destroy($eachUserExperienceResource);
                });
            }

             return $this->userExperienceRepository->destroy($userExperience);
        }

        return false;
    }
}
