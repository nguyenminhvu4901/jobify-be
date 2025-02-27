<?php

namespace App\Commands\UserCertification\GetDetailListOfUserCertificationByUserSlug;

use App\Http\Resources\UserCertification\UserCertificationResource;
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
        try {
            $userCertifications =  $this->userCertificationRepository->getByRelationshipUserSlug(
                $command->userSlug,
                ['userCertificationResources.contentType', 'user']
            );

            return [
                'data' => UserCertificationResource::collection($userCertifications),
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
