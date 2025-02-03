<?php

namespace App\Commands\PersonalInfo\GetCurrentUser;

use App\Repositories\User\UserRepository;

class GetCurrentUserHandler
{
    public function __construct(
        protected UserRepository $userRepository
    )
    {}

    public function handle()
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
