<?php

namespace App\Commands\Auth\SendForgotPassword;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

class SendForgotPasswordCommand implements CommandInterface
{
    public function __construct(
        public readonly string $email
    )
    {}

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            email: $request->get('email')
        );
    }
}
