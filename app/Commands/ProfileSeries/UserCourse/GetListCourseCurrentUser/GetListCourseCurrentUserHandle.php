<?php

namespace App\Commands\ProfileSeries\UserCourse\GetListCourseCurrentUser;

use App\Enums\RouteNames\Profile\UserCourseEnum;
use App\Enums\TTL\CacheTTL;
use App\Http\Resources\ProfileSeries\UserCourse\CurrentUserCourseResource;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Cache;

class GetListCourseCurrentUserHandle
{
    public function __construct(
        protected UserRepository $userRepository
    ) {
    }

    public function handle(): array
    {
        try {
            $cache = Cache::tags([UserCourseEnum::TAG_NAME->value])->has(
                UserCourseEnum::LIST_COURSE_CURRENT_USER->value.auth()->user()->id
            );

            $userCourse = Cache::tags([UserCourseEnum::TAG_NAME->value])
                ->remember(
                    UserCourseEnum::LIST_COURSE_CURRENT_USER->value.auth()->user()->id,
                    CacheTTL::REMEMBER->value,
                    function () {

                        return $this->userRepository->findWithRelationships(
                            id: auth()->user()->id,
                            relationship: 'userCourses.userCourseResources.contentType',
                            relationshipCallbacksToFilter: [
                                'userCourses' => function ($query) {
                                    $query->orderByDesc('id')
                                        ->with([
                                            'userCourseResources' => function ($query) {
                                                $query->orderByDesc('id')
                                                    ->with('contentType');
                                            },
                                        ]);
                                },
                            ]
                        );
                    }
                );

            if (empty($userCourse)) {

                return [
                    'message' => __('messages.profile.user_get_profile_error'),
                ];
            }

            return [
                'data' => CurrentUserCourseResource::make($userCourse),
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
