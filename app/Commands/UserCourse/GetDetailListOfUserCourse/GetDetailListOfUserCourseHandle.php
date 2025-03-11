<?php

namespace App\Commands\UserCourse\GetDetailListOfUserCourse;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\Profile\UserCourse;
use App\Http\Resources\UserCourse\UserCourseResource;
use App\Repositories\UserCourse\UserCourseRepository;
use Illuminate\Support\Facades\Cache;

class GetDetailListOfUserCourseHandle
{
    /**
     * @param UserCourseRepository $userCourseRepository
     */
    public function __construct(
        protected UserCourseRepository $userCourseRepository
    )
    {
    }

    /**
     * @param GetDetailListOfUserCourseCommand $command
     * @return array
     */
    public function handle(GetDetailListOfUserCourseCommand $command): array
    {
        try {
            $cache = Cache::tags([UserCourse::TAG_NAME->value])->has(
                generateCacheName(
                    UserCourse::DETAIL_LIST_USER_COURSE->value,
                    $command
                )
            );

            $userCourse = Cache::tags([UserCourse::TAG_NAME->value])->remember(
                generateCacheName(
                    UserCourse::DETAIL_LIST_USER_COURSE->value,
                    $command
                ),
                CacheTTL::REMEMBER->value,
                fn() => $this->userCourseRepository->findWithRelationships(
                    id: $command->userCourseId,
                    relationship: ['user', 'userCourseResources.contentType']
                )
            );

            if(empty($userCourse)){
                return [
                    'message' => __('messages.profile.user_get_profile_error')
                ];
            }

            return [
                'data' => UserCourseResource::make($userCourse),
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
