<?php

namespace App\Commands\UserCertification\GetDetailListOfUserCertificationByUserSlug;

use App\Repositories\UserCertification\UserCertificationRepository;

class GetDetailListOfUserCertificationByUserSlugHandle
{
    public function __construct(
        protected UserCertificationRepository $userCertificationRepository
    )
    {
    }

    public function handle(GetDetailListOfUserCertificationByUserSlugCommand $command)
    {

        $userCertifications =  $this->userCertificationRepository->findByRelationshipUserSlug(
            $command->userSlug,
            ['userCertificationResources', 'user']
        );

        if(!empty($userCertifications)){
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
