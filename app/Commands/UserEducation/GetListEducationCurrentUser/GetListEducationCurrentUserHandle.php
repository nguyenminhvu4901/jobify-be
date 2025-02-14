<?php

namespace App\Commands\UserEducation\GetListEducationCurrentUser;

use App\Repositories\User\UserRepository;

class GetListEducationCurrentUserHandle
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
        $userId = auth()->user()->id;

        $user = $this->userRepository->findWithRelationships(
            $userId,
            'userEducations',
            [
                'userEducations' => function ($query) {
                    return $query->orderByDesc('id');
                }
            ]
        );

        if(!empty($user)){
            return [
                'user' => $user,
                'message' => __('messages.profile.user_get_profile_success')
            ];
        }

        return [
            'message' => __('messages.profile.user_get_profile_error')
        ];
    }
}
