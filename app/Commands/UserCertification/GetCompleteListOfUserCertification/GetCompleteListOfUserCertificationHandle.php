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

    /**
     * @return array
     */
    public function handle(): array
    {
        $userCertifications = $this->userCertificationRepository->getWithRelationship(
            ['userCertificationResources', 'user']
        );

        if($userCertifications->isNotEmpty()){
            return [
                'userCertifications' => $userCertifications,
                'message' => __('messages.profile.user_get_profile_success')
            ];
        }

        return [
            'message' => __('messages.profile.user_get_profile_error')
        ];
    }
}
