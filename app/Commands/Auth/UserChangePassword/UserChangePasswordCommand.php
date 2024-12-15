<?php

namespace App\Commands\Auth\UserChangePassword;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

class UserChangePasswordCommand implements CommandInterface
{
    public function __construct(
        public readonly string $slug,
        public readonly string $newPassword
    )
    {}

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            slug: $request->get('slug'),
            newPassword: $request->get('new_password')
        );
    }
}
