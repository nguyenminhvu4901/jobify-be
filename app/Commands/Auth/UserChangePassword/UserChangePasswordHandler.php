<?php

namespace App\Commands\Auth\UserChangePassword;

use App\Repositories\User\UserRepository;

class UserChangePasswordHandler
{
    public function __construct(
        protected UserRepository $userRepository
    )
    {}

    public function handle(UserChangePasswordCommand $command)
    {
        $user =  $this->userRepository->changePassword([
            'slug' => $command->slug,
            'new_password' => $command->newPassword
        ]);

        if(!empty($user)){
            return [
                'user' => $user,
                'message' =>  __('messages.profile.user_change_password_success')
            ];
        }

        return [
            'message' => __('messages.profile.user_change_password_error')
        ];
    }

}
