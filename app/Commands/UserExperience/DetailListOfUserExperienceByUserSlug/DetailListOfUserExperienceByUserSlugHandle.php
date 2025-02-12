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
