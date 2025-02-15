<?php

namespace App\Commands\UserCourse\GetListCourseCurrentUser;

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
        $user = auth()->user();

        $userCourses = $this->userRepository->findWithRelationships(
            $user->id,
            'userCourses.userCourseResource',
            [
                'userCourses' => function ($query) {
                    return $query->orderByDesc('id');
                }
            ]
        );

        if(!empty($userCourses)){
            return [
                'userCourses' => $userCourses,
                'message' => __('messages.profile.user_get_profile_success')
            ];
        }

        return [
            'message' => __('messages.profile.user_get_profile_error')
        ];
    }
}
