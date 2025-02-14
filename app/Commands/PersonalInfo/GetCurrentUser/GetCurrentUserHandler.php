<?php

namespace App\Commands\PersonalInfo\GetCurrentUser;

use App\Repositories\User\UserRepository;

class GetCurrentUserHandler
{
    /**
     * @param UserRepository $userRepository
     */
    public function __construct(
        protected UserRepository $userRepository
    )
    {}

    /**
     * @return array
     */
    public function handle(): array
    {
        $userId = auth()->user()->id;

        $user = $this->userRepository->find($userId);

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
