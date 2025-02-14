<?php

namespace App\Commands\Auth\UserChangePassword;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class UserChangePasswordCommand implements CommandInterface
{
    /**
     * @param string $slug
     * @param string $newPassword
     */
    public function __construct(
        public string $slug,
        public string $newPassword
    )
    {}

    /**
     * @param FormRequest $request
     * @return CommandInterface
     */
    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            slug: $request->get('slug'),
            newPassword: $request->get('new_password')
        );
    }
}
