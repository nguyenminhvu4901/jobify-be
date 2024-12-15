<?php

namespace App\Commands\Auth\ResetPassword;

use App\Models\User;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordHandler
{
    public function __construct(
        protected UserRepository $userRepository
    )
    {}

    public function handle(ResetPasswordCommand $command)
    {
        $credentials = [
            'email' => $command->email,
            'password' => $command->password,
            'password_confirmation' => $command->passwordConfirmation,
            'token' => $command->token
        ];

         $status = Password::reset(
            $credentials,
            function (User $user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

         return $status === Password::PASSWORD_RESET
             ? __($status)
             : null;
    }
}
