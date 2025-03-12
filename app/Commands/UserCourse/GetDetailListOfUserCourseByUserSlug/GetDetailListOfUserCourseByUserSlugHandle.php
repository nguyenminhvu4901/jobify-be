<?php

namespace App\Commands\UserCourse\GetDetailListOfUserCourseByUserSlug;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\Profile\UserCourse;
use App\Http\Resources\UserCourse\UserCourseResource;
use App\Repositories\UserCourse\UserCourseRepository;
use Illuminate\Support\Facades\Cache;

class GetDetailListOfUserCourseByUserSlugHandle
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
     * @param GetDetailListOfUserCourseByUserSlugCommand $command
     * @return array
     */
    public function handle(GetDetailListOfUserCourseByUserSlugCommand $command): array
    {
        try {
            $cache = Cache::tags([UserCourse::TAG_NAME->value])->has(
                generateCacheName(
                    UserCourse::DETAIL_LIST_USER_COURSE_BY_USER_SLUG->value,
                    $command
                ));

            $userCourses = Cache::tags([UserCourse::TAG_NAME->value])->remember(
                generateCacheName(
                    UserCourse::DETAIL_LIST_USER_COURSE_BY_USER_SLUG->value,
                    $command
                ),
                CacheTTL::REMEMBER->value, fn() =>
                $this->userCourseRepository->getByRelationshipUserSlug(
                    $command->userSlug,
                    ['userCourseResources.contentType', 'user']
                )
            );

            return [
                'data' => UserCourseResource::collection($userCourses),
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
