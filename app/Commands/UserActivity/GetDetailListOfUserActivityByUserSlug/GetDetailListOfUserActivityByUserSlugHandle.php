<?php

namespace App\Commands\UserActivity\GetDetailListOfUserActivityByUserSlug;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\Profile\UserActivity;
use App\Http\Resources\UserActivity\UserActivityResource;
use App\Repositories\UserActivity\UserActivityRepository;
use Illuminate\Support\Facades\Cache;

class GetDetailListOfUserActivityByUserSlugHandle
{
    /**
     * @param UserActivityRepository $userActivityRepository
     */
    public function __construct(
        protected UserActivityRepository $userActivityRepository
    )
    {
    }

    /**
     * @param GetDetailListOfUserActivityByUserSlugCommand $command
     * @return array
     */
    public function handle(GetDetailListOfUserActivityByUserSlugCommand $command): array
    {
        try {
            $cache = Cache::tags([UserActivity::TAG_NAME->value])->has(
                generateCacheName(
                    UserActivity::DETAIL_LIST_USER_ACTIVITY_BY_USER_SLUG->value,
                    $command
                ));

            $userActivity = Cache::tags([UserActivity::TAG_NAME->value])->remember(
                generateCacheName(
                    UserActivity::DETAIL_LIST_USER_ACTIVITY_BY_USER_SLUG->value,
                    $command
                ),
                CacheTTL::REMEMBER->value, function () use($command){

                return $this->userActivityRepository->getByRelationshipUserSlug(
                    userSlug: $command->userSlug,
                    relationship: ['userActivityResources.contentType', 'user']
                );
            });

            return [
                'data' => UserActivityResource::collection($userActivity),
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
