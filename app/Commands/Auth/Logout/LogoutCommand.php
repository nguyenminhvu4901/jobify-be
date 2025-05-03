<?php

namespace App\Commands\Auth\Logout;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

class LogoutCommand implements CommandInterface
{
    public function __construct(public ?string $token)
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(token: $request->get('token'));
    }
}
