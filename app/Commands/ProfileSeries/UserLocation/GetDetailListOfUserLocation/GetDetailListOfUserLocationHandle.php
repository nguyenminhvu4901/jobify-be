<?php

namespace App\Commands\ProfileSeries\UserLocation\GetDetailListOfUserLocation;

use App\Enums\RouteNames\Profile\UserLocationEnum;
use App\Enums\TTL\CacheTTL;
use App\Http\Resources\ProfileSeries\UserLocation\UserLocationResource;
use App\Repositories\ProfileSeries\UserLocation\UserLocationRepository;
use Illuminate\Support\Facades\Cache;

class GetDetailListOfUserLocationHandle
{
    public function __construct(
        protected UserLocationRepository $userLocationRepository
    ) {
    }

    public function handle(GetDetailListOfUserLocationCommand $command): array
    {
        try {
            $cache = Cache::tags([UserLocationEnum::TAG_NAME->value])->has(
                generateCacheName(
                    UserLocationEnum::DETAIL_LIST_USER_LOCATION->value,
                    $command
                )
            );

            $userLocation = Cache::tags([UserLocationEnum::TAG_NAME->value])->remember(
                generateCacheName(
                    UserLocationEnum::DETAIL_LIST_USER_LOCATION->value,
                    $command
                ),
                CacheTTL::REMEMBER->value,
                fn () => $this->userLocationRepository->findWithRelationships(
                    id: $command->userLocationId,
                    relationship: 'user'
                )
            );

            if (empty($userLocation)) {
                return [
                    'message' => __('messages.profile.user_get_profile_error'),
                ];
            }

            return [
                'data' => UserLocationResource::make($userLocation),
                'message' => __('messages.profile.user_get_profile_success'),
                'cache' => $cache,
            ];
        } catch (\Exception $e) {

            return [
                'message' => __('messages.profile.user_get_profile_error'),
                'error' => $e,
            ];
        }
    }
}
