<?php

namespace App\Commands\UserCertification\GetCompleteListOfUserCertification;

use App\Repositories\UserCertification\UserCertificationRepository;

class GetCompleteListOfUserCertificationHandle
{
    public function __construct(
        protected UserCertificationRepository $userCertificationRepository
    )
    {
    }

    public function handle()
    {
        $userEducations = $this->userCertificationRepository->getWithRelationship(
            ['userCertificationResources', 'user']
        );

        if(!empty($userEducations)){
            return [
                'userEducations' => $userEducations,
                'message' => __('messages.profile.user_get_profile_success')
            ];
        }

        return [
            'message' => __('messages.profile.user_get_profile_error')
        ];
    }
}
