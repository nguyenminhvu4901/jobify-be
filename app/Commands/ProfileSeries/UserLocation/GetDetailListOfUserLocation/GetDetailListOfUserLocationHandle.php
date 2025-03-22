<?php

namespace App\Commands\ProfileSeries\UserLocation\GetDetailListOfUserLocation;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\Profile\UserLocation;
use App\Http\Resources\ProfileSeries\UserLocation\UserLocationResource;
use App\Repositories\ProfileSeries\UserLocation\UserLocationRepository;
use Illuminate\Support\Facades\Cache;

class GetDetailListOfUserLocationHandle
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
     * @param GetDetailListOfUserLocationCommand $command
     * @return array
     */
    public function handle(GetDetailListOfUserLocationCommand $command): array
    {
        try {
            $cache = Cache::tags([UserLocation::TAG_NAME->value])->has(
                generateCacheName(
                    UserLocation::DETAIL_LIST_USER_LOCATION->value,
                    $command
                )
            );

            $userLocation = Cache::tags([UserLocation::TAG_NAME->value])->remember(
                generateCacheName(
                    UserLocation::DETAIL_LIST_USER_LOCATION->value,
                    $command
                ),
                CacheTTL::REMEMBER->value,
                fn() => $this->userLocationRepository->findWithRelationships(
                    id: $command->userLocationId,
                    relationship: 'user'
                ));

            if(empty($userLocation)){
                return [
                    'message' => __('messages.profile.user_get_profile_error')
                ];
            }

            return [
                'data' => UserLocationResource::make($userLocation),
                'message' => __('messages.profile.user_get_profile_success'),
                'cache' => $cache
            ];
        }catch (\Exception $e){

            return [
                'message' => __('messages.profile.user_get_profile_error'),
                'error' => $e
            ];
        }
    }
}
