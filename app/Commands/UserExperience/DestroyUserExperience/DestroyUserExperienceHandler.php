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
     * @return array
     */
    public function handle(DestroyUserExperienceCommand $command): ?array
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

            $userExperienceDestroy = $this->userExperienceRepository->destroy($userExperience);

            if($userExperienceDestroy){
                return [
                    'userExperienceDestroy' => $userExperienceDestroy,
                    'message' =>__('messages.profile.user_destroy_profile_success')
                ];
            }
        }

        return [
            'message' =>__('messages.profile.user_destroy_profile_error')
        ];
    }
}
