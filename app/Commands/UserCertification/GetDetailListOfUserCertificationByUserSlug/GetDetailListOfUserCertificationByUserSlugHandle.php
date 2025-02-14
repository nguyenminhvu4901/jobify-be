<?php

namespace App\Commands\UserCertification\GetDetailListOfUserCertificationByUserSlug;

use App\Repositories\UserCertification\UserCertificationRepository;

class GetDetailListOfUserCertificationByUserSlugHandle
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
     * @param GetDetailListOfUserCertificationByUserSlugCommand $command
     * @return array
     */
    public function handle(GetDetailListOfUserCertificationByUserSlugCommand $command): array
    {

        $userCertifications =  $this->userCertificationRepository->getByRelationshipUserSlug(
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
