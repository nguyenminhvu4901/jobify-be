<?php

namespace App\Commands\Auth\UserChangePassword;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class UserChangePasswordCommand implements CommandInterface
{
    public function __construct(
        public string $slug,
        public string $newPassword
    ) {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            slug: $request->get('slug'),
            newPassword: $request->get('new_password')
        );
    }
}
