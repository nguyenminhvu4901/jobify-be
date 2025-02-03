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
        $userEducation = $this->userEducationRepository->find($command->userEducationId);

        if(!empty($userEducation)){
            return [
                'userEducation' => $userEducation,
                'message' => __('messages.profile.user_get_profile_success')
            ];
        }

        return [
            'message' => __('messages.profile.user_get_profile_error')
        ];
    }
}
