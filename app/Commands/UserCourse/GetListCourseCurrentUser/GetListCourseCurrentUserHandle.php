<?php

namespace App\Commands\UserCourse\GetListCourseCurrentUser;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\Profile\UserCourse;
use App\Http\Resources\UserCourse\CurrentUserCourseResource;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Cache;

class GetListCourseCurrentUserHandle
{
    /**
     * @param UserRepository $userRepository
     */
    public function __construct(
        protected UserRepository $userRepository
    )
    {
    }

    /**
     * @return array
     */
    public function handle(): array
    {
        try {
            $cache = Cache::tags([UserCourse::TAG_NAME->value])->has(
                UserCourse::LIST_COURSE_CURRENT_USER->value . auth()->user()->id);

            $userCourse = Cache::tags([UserCourse::TAG_NAME->value])
                ->remember(
                    UserCourse::LIST_COURSE_CURRENT_USER->value . auth()->user()->id,
                    CacheTTL::REMEMBER->value,
                    function() {

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
                                            }
                                        ]);
                                }
                            ]
                        );
                    });

            if(empty($userCourse)){

                return [
                    'message' => __('messages.profile.user_get_profile_error')
                ];
            }

            return [
                'data' => CurrentUserCourseResource::make($userCourse),
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
