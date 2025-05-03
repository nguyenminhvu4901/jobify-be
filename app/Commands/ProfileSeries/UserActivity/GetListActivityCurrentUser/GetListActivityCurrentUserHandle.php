<?php

namespace App\Commands\ProfileSeries\UserActivity\GetListActivityCurrentUser;

use App\Enums\RouteNames\Profile\UserActivityEnum;
use App\Enums\TTL\CacheTTL;
use App\Http\Resources\ProfileSeries\UserActivity\CurrentUserActivityResource;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Cache;

class GetListActivityCurrentUserHandle
{
    public function __construct(
        protected UserRepository $userRepository
    ) {
    }

    public function handle(): array
    {
        try {
            $cache = Cache::tags([UserActivityEnum::TAG_NAME->value])->has(
                UserActivityEnum::LIST_ACTIVITY_CURRENT_USER->value.auth()->user()->id
            );

            $userActivities = Cache::tags([UserActivityEnum::TAG_NAME->value])
                ->remember(
                    UserActivityEnum::LIST_ACTIVITY_CURRENT_USER->value.auth()->user()->id,
                    CacheTTL::REMEMBER->value,
                    fn () => $this->userRepository->findWithRelationships(
                        id: auth()->user()->id,
                        relationship: 'userActivities.userActivityResources.contentType',
                        relationshipCallbacksToFilter: [
                            'userActivities' => function ($query) {
                                $query->orderByDesc('id')
                                    ->with([
                                        'userActivityResources' => function ($query) {
                                            $query->orderByDesc('id')
                                                ->with('contentType');
                                        },
                                    ]);
                            },
                        ]
                    )
                );

            if (empty($userActivities)) {
                return [
                    'message' => __('messages.profile.user_get_profile_error'),
                ];
            }

            return [
                'data' => CurrentUserActivityResource::make($userActivities),
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
