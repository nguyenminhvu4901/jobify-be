<?php

namespace App\Commands\ProfileSeries\UserLocation\GetCompleteListOfUserLocation;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\Profile\UserLocation;
use App\Helpers\Global\PaginationHelper;
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
            $cache = Cache::tags([UserLocation::TAG_NAME->value])
                ->has(
                    generateCacheName(
                        UserLocation::COMPLETE_LIST_USER_LOCATION->value,
                        $command
                    )
                );

            $userLocation = Cache::tags([UserLocation::TAG_NAME->value])->remember(
                generateCacheName(
                    UserLocation::COMPLETE_LIST_USER_LOCATION->value,
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
                'pagination' => PaginationHelper::formatPaginationData($userLocation) ?? []
            ];
        }catch (\Exception $e){

            return [
                'message' => __('messages.profile.user_get_profile_error'),
                'error' => $e
            ];
        }
    }
}
