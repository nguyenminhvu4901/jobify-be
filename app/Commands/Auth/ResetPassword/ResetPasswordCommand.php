<?php

namespace App\Commands\Auth\ResetPassword;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class ResetPasswordCommand implements CommandInterface
{
    public function __construct(
        public string $email,
        public string $token,
        public string $password,
        public string $passwordConfirmation
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
