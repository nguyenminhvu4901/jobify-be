<?php

namespace App\Commands\UserEducation\GetCompleteListOfUserEducation;

use App\Repositories\UserEducation\UserEducationRepository;

class GetCompleteListOfUserEducationHandle
{
    /**
     * @param UserEducationRepository $userEducationRepository
     */
    public function __construct(
        protected UserEducationRepository $userEducationRepository
    )
    {
    }

    /**
     * @return array
     */
    public function handle(): array
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
