<?php

namespace App\Commands\UserCourse\GetListCourseCurrentUser;

use App\Http\Resources\UserCourse\CurrentUserCourseResource;
use App\Repositories\User\UserRepository;

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
            $user = auth()->user();

            $userCourses = $this->userRepository->findWithRelationships(
                $user->id,
                'userCourses.userCourseResources.contentType',
                [
                    'userCourses' => function ($query) {
                        return $query->orderByDesc('id');
                    }
                ]
            );

            return [
                'userCourses' => CurrentUserCourseResource::make($userCourses),
                'message' => __('messages.profile.user_get_profile_success')
            ];
        }catch (\Exception $e){
            return [
                'message' => __('messages.profile.user_get_profile_error'),
                'error' => $e
            ];
        }
    }
}
