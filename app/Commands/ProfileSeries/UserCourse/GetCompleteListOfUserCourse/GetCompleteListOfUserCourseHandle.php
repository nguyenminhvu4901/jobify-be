<?php

namespace App\Commands\ProfileSeries\UserCourse\GetCompleteListOfUserCourse;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\Profile\UserCourseEnum;
use App\Http\Resources\ProfileSeries\UserCourse\UserCourseResource;
use App\Repositories\ProfileSeries\UserCourse\UserCourseRepository;
use Exception;
use Illuminate\Support\Facades\Cache;

class GetCompleteListOfUserCourseHandle
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
     * @param GetCompleteListOfUserCourseCommand $command
     * @return array
     */
    public function handle(GetCompleteListOfUserCourseCommand $command): array
    {
        try {
            $cache = Cache::tags([UserCourseEnum::TAG_NAME->value])
                ->has(
                    generateCacheName(
                        UserCourseEnum::COMPLETE_LIST_USER_COURSE->value,
                        $command
                    )
                );

            $userCourses = Cache::tags([UserCourseEnum::TAG_NAME->value])->remember(
                generateCacheName(
                    UserCourseEnum::COMPLETE_LIST_USER_COURSE->value,
                    $command
                ),
                CacheTTL::REMEMBER->value,
                fn() => $this->userCourseRepository->paginateWithRelationship(
                    relationship: ['userCourseResources.contentType', 'user'],
                    limit: $command->limit
                )
            );

            return [
                'data' => UserCourseResource::collection($userCourses),
                'message' => __('messages.profile.user_get_profile_success'),
                'cache' => $cache,
                'pagination' => formatPaginationData($userCourses ?? [])
            ];
        }catch (Exception $e){
            return [
                'message' => __('messages.profile.user_get_profile_error'),
                'error' => $e
            ];
        }
    }
}
