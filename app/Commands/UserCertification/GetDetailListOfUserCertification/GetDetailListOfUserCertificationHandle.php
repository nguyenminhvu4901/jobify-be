<?php

namespace App\Commands\UserCertification\GetDetailListOfUserCertification;

use App\Repositories\UserCertification\UserCertificationRepository;

class GetDetailListOfUserCertificationHandle
{
    /**
     * @param UserCertificationRepository $userCertificationRepository
     */
    public function __construct(
        protected UserCertificationRepository $userCertificationRepository
    )
    {
    }

    /**
     * @param GetDetailListOfUserCertificationCommand $command
     * @return array
     */
    public function handle(GetDetailListOfUserCertificationCommand $command): array
    {
        $userCertification = $this->userCertificationRepository->findWithRelationships(
            $command->userCertificationId,
            ['user', 'userCertificationResources']
        );

        if(!empty($userCertification)){
            return [
                'userCertification' => $userCertification,
                'message' => __('messages.profile.user_get_profile_success')
            ];
        }

        return [
            'message' => __('messages.profile.user_get_profile_error')
        ];
    }
}
