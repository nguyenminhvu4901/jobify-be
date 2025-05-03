<?php

namespace App\Commands\Auth\Refresh;

use App\Http\Resources\Auth\LoginResource;
use App\Repositories\User\UserRepository;
use Tymon\JWTAuth\Facades\JWTAuth;

class RefreshHandler
{
    public function __construct(
        protected UserRepository $userRepository
    ) {
    }

    public function handle(): array
    {
        try {
            $newToken = JWTAuth::refresh(JWTAuth::getToken());

            if (! empty($newToken)) {
                return [
                    'user' => LoginResource::make(auth()->user()),
                    'message' => __('messages.authentication.user_login_success'),
                ];
            }

            return [
                'message' => __('messages.authentication.user_login_error'),
            ];
        } catch (\Exception $e) {

            return [
                'message' => __('messages.authentication.user_login_error'),
                'error' => $e,
            ];
        }
    }
}
