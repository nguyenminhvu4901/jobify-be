<?php

namespace App\Commands\Auth\Logout;

use Tymon\JWTAuth\Facades\JWTAuth;

class LogoutHandler
{
    public function handle(LogoutCommand $command)
    {
        return JWTAuth::setToken($command->token)->invalidate(true);
    }
}
