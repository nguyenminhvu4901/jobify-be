<?php

namespace App\Commands\UserCertification\GetDetailListOfUserCertification;

use App\Http\Resources\UserCertification\UserCertificationResource;
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
        try {
            $userCertification = $this->userCertificationRepository->findWithRelationships(
                $command->userCertificationId,
                ['user', 'userCertificationResources']
            );

            return [
                'userCertification' => UserCertificationResource::make($userCertification),
                'message' => __('messages.profile.user_get_profile_success')
            ];
        }catch (\Exception $e){
            return [
                'message' => __('messages.profile.user_get_profile_error'),
                'error' => $e
            ];
        }
    }
}
