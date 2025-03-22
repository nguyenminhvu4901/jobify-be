<?php

namespace App\Commands\Profile\UserLocation\DestroyUserLocation;

use App\Repositories\UserLocation\UserLocationRepository;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class DestroyUserRequestHandle
{
    /**
     * @param UserLocationRepository $userLocationRepository
     */
    public function __construct(
        protected UserLocationRepository $userLocationRepository
    )
    {
    }

    /**
     * @param DestroyUserLocationCommand $command
     * @return array
     */
    public function handle(DestroyUserLocationCommand $command): array
    {
        try {
            $userLocation = $this->userLocationRepository->findByRelationshipUserSlugAndColumnDetailId(
                $command->userSlug, $command->userLocationId
            );

            if (!$userLocation) {
                return [
                    'message' => __('messages.response.resource_not_found'),
                    'status_code' => ResponseAlias::HTTP_NOT_FOUND
                ];
            }

            $result = $this->userLocationRepository->destroyDataWithTransaction($userLocation->id);

            if ($result['success']) {
                return [
                    'userLocationDestroy' => $result['success'],
                    'message' => __('messages.profile.user_destroy_profile_success')
                ];
            }

            return [
                'message' => __('messages.profile.user_destroy_profile_error'),
                'status_code' => ResponseAlias::HTTP_INTERNAL_SERVER_ERROR
            ];
        }catch (\Exception $e){

            return [
                'message' => __('messages.profile.user_destroy_profile_error'),
                'error' => $e,
                'status_code' => ResponseAlias::HTTP_INTERNAL_SERVER_ERROR
            ];
        }
    }
}
