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

    public function handle()
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
