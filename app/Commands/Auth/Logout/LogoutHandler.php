<?php

namespace App\Commands\Auth\Logout;

use Tymon\JWTAuth\Facades\JWTAuth;

class LogoutHandler
{
    public function handle(LogoutCommand $command): array
    {
        try {
            if (! empty($command->token)) {
                $tokenInfo = JWTAuth::setToken($command->token)->invalidate(true);

                if ($tokenInfo) {
                    return [
                        'logout' => true,
                        'message' => __('messages.authentication.user_is_logged_out'),
                    ];
                }
            }

            return [
                'logout' => false,
                'message' => __('messages.authentication.user_logout_error'),
            ];

        } catch (\Exception $e) {
            return [
                'logout' => false,
                'message' => __('messages.authentication.user_logout_error'),
                'error' => $e,
            ];
        }
    }
}
