<?php

namespace App\Commands\Auth\Logout;

use App\Commands\CommandInterface;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Http\FormRequest;

readonly class LogoutCommand {
    public function __construct(public ?string $token)
    {
    }
}
