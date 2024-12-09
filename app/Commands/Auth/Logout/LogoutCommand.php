<?php

namespace App\Commands\Auth\Logout;

use App\Commands\CommandInterface;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Http\FormRequest;

class LogoutCommand {
    public function __construct(public readonly ?string $token)
    {
    }
}
