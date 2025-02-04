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
        $userEducation = $this->userEducationRepository->getWithRelationship('user');

        if($userEducation->isNotEmpty()){
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
