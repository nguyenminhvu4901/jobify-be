<?php

namespace App\Commands\ProfileSeries\UserCourse\GetDetailListOfUserCourse;

use App\Enums\RouteNames\Profile\UserCourseEnum;
use App\Enums\TTL\CacheTTL;
use App\Http\Resources\ProfileSeries\UserCourse\UserCourseResource;
use App\Repositories\ProfileSeries\UserCourse\UserCourseRepository;
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
            $cache = Cache::tags([UserCourseEnum::TAG_NAME->value])->has(
                generateCacheName(
                    UserCourseEnum::DETAIL_LIST_USER_COURSE->value,
                    $command
                )
            );

            $userCourse = Cache::tags([UserCourseEnum::TAG_NAME->value])->remember(
                generateCacheName(
                    UserCourseEnum::DETAIL_LIST_USER_COURSE->value,
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
