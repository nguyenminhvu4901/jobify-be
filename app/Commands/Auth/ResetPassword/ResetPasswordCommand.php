<?php

namespace App\Commands\Auth\ResetPassword;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordCommand implements CommandInterface
{
    public function __construct(
        public readonly string $email,
        public readonly string $token,
        public readonly string $password,
        public readonly string $passwordConfirmation
    )
    {}

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            email: $request->get('email'),
            token: $request->get('token'),
            password: $request->get('password'),
            passwordConfirmation: $request->get('password_confirmation')
        );
    }
}
