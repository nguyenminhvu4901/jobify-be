<?php

namespace App\Commands\UserExperience\GetCompleteListOfUserExperience;

use App\Repositories\UserExperience\UserExperienceRepository;

class GetCompleteListOfUserExperienceHandler
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
     * @return array
     */
    public function handle(): array
    {
        $userExperiences = $this->userExperienceRepository->getWithRelationship(
            ['userExperienceResource', 'user']
        );

        if($userExperiences->isNotEmpty()){
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
