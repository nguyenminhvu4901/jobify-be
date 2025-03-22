<?php

namespace App\Commands\UserLocation\GetListLocationCurrentUser;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\Profile\UserLocation;
use App\Http\Resources\Profile\UserLocation\CurrentUserLocationResource;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Cache;

class GetListLocationCurrentUserHandle
{
    public function __construct(
        protected UserRepository $userRepository
    )
    {
    }

    public function handle(): array
    {
        try {
            $cache = Cache::tags([UserLocation::TAG_NAME->value])->has(
                UserLocation::LIST_LOCATION_CURRENT_USER->value . auth()->user()->id
            );

            $userLocation = Cache::tags([UserLocation::TAG_NAME->value])
                ->remember(
                    UserLocation::LIST_LOCATION_CURRENT_USER->value . auth()->user()->id,
                    CacheTTL::REMEMBER->value,
                    fn() => $this->userRepository->findWithRelationships(
                        id: auth()->user()->id,
                        relationship: ['userLocations'],
                        relationshipCallbacksToFilter: [
                            'userLocations' => function ($query) {
                                return $query->orderByDesc('id');
                            }
                        ]
                    )
                );

            if(empty($userLocation)){

                return [
                    'message' => __('messages.profile.user_get_profile_error')
                ];
            }

            return [
                'data' => CurrentUserLocationResource::make($userLocation),
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
