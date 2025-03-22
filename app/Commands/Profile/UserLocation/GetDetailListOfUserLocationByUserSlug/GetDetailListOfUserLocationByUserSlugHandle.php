<?php

namespace App\Commands\Profile\UserLocation\GetDetailListOfUserLocationByUserSlug;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\Profile\UserLocation;
use App\Http\Resources\Profile\UserLocation\UserLocationResource;
use App\Repositories\UserLocation\UserLocationRepository;
use Illuminate\Support\Facades\Cache;

class GetDetailListOfUserLocationByUserSlugHandle
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
     * @param GetDetailListOfUserLocationByUserSlugCommand $command
     * @return array
     */
    public function handle(GetDetailListOfUserLocationByUserSlugCommand $command): array
    {
        try {
            $cache = Cache::tags([UserLocation::TAG_NAME->value])->has(
                generateCacheName(
                    UserLocation::DETAIL_LIST_USER_LOCATION_BY_USER_SLUG->value,
                    $command
                )
            );

            $userLocation = Cache::tags([UserLocation::TAG_NAME->value])->remember(
                generateCacheName(
                    UserLocation::DETAIL_LIST_USER_LOCATION_BY_USER_SLUG->value,
                    $command
                ),
                CacheTTL::REMEMBER->value,
                fn() =>  $this->userLocationRepository->getByRelationshipUserSlug(
                    userSlug: $command->userSlug,
                    relationship: ['user', 'province', 'district', 'ward']
                )
            );

            return [
                'data' => UserLocationResource::collection($userLocation),
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
