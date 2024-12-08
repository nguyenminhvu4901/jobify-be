<?php

namespace App\Commands\Auth\LoginStandard;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

class LoginStandardCommand implements CommandInterface
{
    /**
     * @param string $email
     * @param string $password
     * @param bool|null $remember
     */
    public function __construct(
        public readonly string $email,
        public readonly string $password,
        public readonly ?bool $remember
    ){}

    /**
     * @param FormRequest $request
     * @return CommandInterface
     */
    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            email: $request->get('email'),
            password: $request->get('password'),
            remember: $request->get('remember')
        );
    }
}
