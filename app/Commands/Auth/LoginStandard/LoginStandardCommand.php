<?php

namespace App\Commands\Auth\LoginStandard;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class LoginStandardCommand implements CommandInterface
{
    public function __construct(
        public string $email,
        public string $password,
        public ?bool $remember
    ) {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            email: $request->get('email'),
            password: $request->get('password'),
            remember: $request->get('remember')
        );
    }
}
