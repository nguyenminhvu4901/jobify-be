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
        $userExperience = $this->userExperienceRepository->find($command->userExperienceId);

        if(!empty($userExperience)){
            return [
                'userExperience' => $userExperience,
                'message' => __('messages.profile.user_get_profile_success')
            ];
        }

        return [
            'message' => __('messages.profile.user_get_profile_error')
        ];
    }
}
