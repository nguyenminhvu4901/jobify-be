<?php

namespace App\Commands\UserEducation\GetDetailListOfUserEducation;

use App\Repositories\UserEducation\UserEducationRepository;

class GetDetailListOfUserEducationHandle
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
     * @param GetDetailListOfUserEducationCommand $command
     * @return array
     */
    public function handle(GetDetailListOfUserEducationCommand $command): array
    {
        $userEducation = $this->userEducationRepository->findWithRelationships(
            $command->userEducationId,
            'user'
        );

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
