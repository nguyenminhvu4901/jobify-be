<?php

namespace App\Commands\UserCertification\GetDetailListOfUserCertification;

use App\Repositories\UserCertification\UserCertificationRepository;

class GetDetailListOfUserCertificationHandle
{
    public function __construct(
        protected UserCertificationRepository $userCertificationRepository
    )
    {
    }

    public function handle(GetDetailListOfUserCertificationCommand $command)
    {
        $userCertification = $this->userCertificationRepository->find($command->userCertificationId);

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
