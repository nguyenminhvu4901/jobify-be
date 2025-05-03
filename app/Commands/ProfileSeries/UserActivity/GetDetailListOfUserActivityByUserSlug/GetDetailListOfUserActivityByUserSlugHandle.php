<?php

namespace App\Commands\ProfileSeries\UserActivity\GetDetailListOfUserActivityByUserSlug;

use App\Enums\RouteNames\Profile\UserActivityEnum;
use App\Enums\TTL\CacheTTL;
use App\Http\Resources\ProfileSeries\UserActivity\UserActivityResource;
use App\Repositories\ProfileSeries\UserActivity\UserActivityRepository;
use Illuminate\Support\Facades\Cache;

class GetDetailListOfUserActivityByUserSlugHandle
{
    public function __construct(
        protected UserActivityRepository $userActivityRepository
    ) {
    }

    public function handle(GetDetailListOfUserActivityByUserSlugCommand $command): array
    {
        try {
            $cache = Cache::tags([UserActivityEnum::TAG_NAME->value])->has(
                generateCacheName(
                    UserActivityEnum::DETAIL_LIST_USER_ACTIVITY_BY_USER_SLUG->value,
                    $command
                )
            );

            $userActivity = Cache::tags([UserActivityEnum::TAG_NAME->value])->remember(
                generateCacheName(
                    UserActivityEnum::DETAIL_LIST_USER_ACTIVITY_BY_USER_SLUG->value,
                    $command
                ),
                CacheTTL::REMEMBER->value,
                fn () => $this->userActivityRepository->getByRelationshipUserSlug(
                    userSlug: $command->userSlug,
                    relationship: ['userActivityResources.contentType', 'user']
                )
            );

            return [
                'data' => UserActivityResource::collection($userActivity),
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
