<?php

namespace App\Commands\Auth\UserChangePassword;

use App\Http\Resources\Auth\UserChangePasswordResource;
use App\Repositories\User\UserRepository;

class UserChangePasswordHandler
{
    /**
     * @param UserRepository $userRepository
     */
    public function __construct(
        protected UserRepository $userRepository
    )
    {}

    /**
     * @param UserChangePasswordCommand $command
     * @return array
     */
    public function handle(UserChangePasswordCommand $command): array
    {
        try {
            $user = $this->userRepository->changePassword([
                'slug' => $command->slug,
                'new_password' => $command->newPassword
            ]);

            if (empty($user)) {
                return [
                    'message' => __('messages.profile.user_change_password_error'),
                ];
            }

            return [
                'user' => UserChangePasswordResource::make($user->refresh()),
                'message' =>  __('messages.profile.user_change_password_success')
            ];
        }catch (\Exception $e){
            return [
                'message' => __('messages.profile.user_change_password_error'),
                'error' => $e
            ];
        }
    }

}
