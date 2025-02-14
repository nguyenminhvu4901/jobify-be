<?php

namespace App\Commands\UserExperience\DetailListOfUserExperienceByUserSlug;

use App\Repositories\UserExperience\UserExperienceRepository;

class DetailListOfUserExperienceByUserSlugHandle
{
    /**
     * @param UserExperienceRepository $userExperienceRepository
     */
    public function __construct(
        protected UserExperienceRepository $userExperienceRepository
    )
    {
    }

    /**
     * @param DetailListOfUserExperienceByUserSlugCommand $command
     * @return array
     */
    public function handle(DetailListOfUserExperienceByUserSlugCommand $command): array
    {
        $userExperiences = $this->userExperienceRepository->getByRelationshipUserSlug(
            $command->userSlug,
            ['userExperienceResource', 'user']
        );

        if(!empty($userExperiences)){
            return [
                'userExperiences' => $userExperiences,
                'message' => __('messages.profile.user_get_profile_success')
            ];
        }

        return [
            'message' => __('messages.profile.user_get_profile_error')
        ];
    }
}
