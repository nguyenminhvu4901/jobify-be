<?php

namespace App\Commands\Auth\Logout;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

class LogoutCommand implements CommandInterface{
    /**
     * @param string|null $token
     */
    public function __construct(public ?string $token)
    {
    }

    /**
     * @param FormRequest $request
     * @return CommandInterface
     */
    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(token: $request->get('token'));
    }
}
