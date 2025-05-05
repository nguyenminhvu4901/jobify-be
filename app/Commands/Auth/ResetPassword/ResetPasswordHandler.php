<?php

namespace App\Commands\Auth\ResetPassword;

use App\Models\User;
use App\Repositories\User\UserRepository;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordHandler
{
    /**
     * @param UserRepository $userRepository
     */
    public function __construct(
        protected UserRepository $userRepository
    )
    {}

    /**
     * @param ResetPasswordCommand $command
     * @return Application|array|string|Translator|null
     */
    public function handle(ResetPasswordCommand $command): Application|array|string|Translator|null
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
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

         return $status === Password::PASSWORD_RESET
             ? __($status)
             : null;
    }
}
