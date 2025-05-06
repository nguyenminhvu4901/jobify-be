<?php

namespace App\Commands\ProfileSeries\UserLocation\GetCompleteListOfUserLocation;

use App\Enums\RouteNames\Profile\UserLocationEnum;
use App\Enums\TTL\CacheTTL;
use App\Http\Resources\ProfileSeries\UserLocation\UserLocationResource;
use App\Repositories\ProfileSeries\UserLocation\UserLocationRepository;
use Illuminate\Support\Facades\Cache;

class GetCompleteListOfUserLocationHandle
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
     * @param GetCompleteListOfUserLocationCommand $command
     * @return array
     */
    public function handle(GetCompleteListOfUserLocationCommand $command): array
    {
        try {
            $cache = redisCacheDB()->tags([UserLocationEnum::TAG_NAME->value])
                ->has(
                    generateCacheName(
                        UserLocationEnum::COMPLETE_LIST_USER_LOCATION->value,
                        $command
                    )
                );

            $userLocation = redisCacheDB()->tags([UserLocationEnum::TAG_NAME->value])->remember(
                generateCacheName(
                    UserLocationEnum::COMPLETE_LIST_USER_LOCATION->value,
                    $command
                ),
                CacheTTL::REMEMBER->value,
                fn() => $this->userLocationRepository->paginateWithRelationship(
                    relationship: ['user', 'province', 'district', 'ward'],
                    limit: $command->limit
                )
            );

            return [
                'data' => UserLocationResource::collection($userLocation),
                'message' => __('messages.profile.user_get_profile_success'),
                'cache' => $cache,
                'pagination' => formatPaginationData($userLocation ?? [])
            ];
        }catch (\Exception $e){

            return [
                'message' => __('messages.profile.user_get_profile_error'),
                'error' => $e
            ];
        }
    }
}
