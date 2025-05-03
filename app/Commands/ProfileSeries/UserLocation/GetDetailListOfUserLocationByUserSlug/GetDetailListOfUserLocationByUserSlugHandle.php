<?php

namespace App\Commands\ProfileSeries\UserLocation\GetDetailListOfUserLocationByUserSlug;

use App\Enums\RouteNames\Profile\UserLocationEnum;
use App\Enums\TTL\CacheTTL;
use App\Http\Resources\ProfileSeries\UserLocation\UserLocationResource;
use App\Repositories\ProfileSeries\UserLocation\UserLocationRepository;
use Illuminate\Support\Facades\Cache;

class GetDetailListOfUserLocationByUserSlugHandle
{
    public function __construct(
        protected UserLocationRepository $userLocationRepository
    ) {
    }

    public function handle(GetDetailListOfUserLocationByUserSlugCommand $command): array
    {
        try {
            $cache = Cache::tags([UserLocationEnum::TAG_NAME->value])->has(
                generateCacheName(
                    UserLocationEnum::DETAIL_LIST_USER_LOCATION_BY_USER_SLUG->value,
                    $command
                )
            );

            $userLocation = Cache::tags([UserLocationEnum::TAG_NAME->value])->remember(
                generateCacheName(
                    UserLocationEnum::DETAIL_LIST_USER_LOCATION_BY_USER_SLUG->value,
                    $command
                ),
                CacheTTL::REMEMBER->value,
                fn () => $this->userLocationRepository->getByRelationshipUserSlug(
                    userSlug: $command->userSlug,
                    relationship: ['user', 'province', 'district', 'ward']
                )
            );

            return [
                'data' => UserLocationResource::collection($userLocation),
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
