<?php

namespace App\Commands\ProfileSeries\UserActivity\GetDetailListOfUserActivity;

use App\Enums\RouteNames\Profile\UserActivityEnum;
use App\Enums\TTL\CacheTTL;
use App\Http\Resources\ProfileSeries\UserActivity\UserActivityResource;
use App\Repositories\ProfileSeries\UserActivity\UserActivityRepository;
use Illuminate\Support\Facades\Cache;

class GetDetailListOfUserActivityHandle
{
    public function __construct(
        protected UserActivityRepository $userActivityRepository
    ) {
    }

    public function handle(GetDetailListOfUserActivityCommand $command): array
    {
        try {
            $cache = Cache::tags([UserActivityEnum::TAG_NAME->value])->has(
                generateCacheName(
                    UserActivityEnum::DETAIL_LIST_USER_ACTIVITY->value,
                    $command
                )
            );

            $userActivity = Cache::tags([UserActivityEnum::TAG_NAME->value])->remember(
                generateCacheName(
                    UserActivityEnum::DETAIL_LIST_USER_ACTIVITY->value,
                    $command
                ),
                CacheTTL::REMEMBER->value,
                fn () => $this->userActivityRepository->findWithRelationships(
                    id: $command->userActivityId,
                    relationship: ['user', 'userActivityResources.contentType']
                )
            );

            if (empty($userActivity)) {
                return [
                    'message' => __('messages.profile.user_get_profile_error'),
                ];
            }

            return [
                'data' => UserActivityResource::make($userActivity),
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
