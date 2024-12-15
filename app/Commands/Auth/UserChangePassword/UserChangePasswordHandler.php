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
        return $this->userRepository->changePassword([
            'slug' => $command->slug,
            'new_password' => $command->newPassword
        ]);
    }

}
