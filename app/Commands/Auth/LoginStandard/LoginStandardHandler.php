<?php

namespace App\Commands\Auth\LoginStandard;

use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginStandardHandler
{
    public function __construct(
        protected UserRepository $userRepository)
    {
    }

    public function handle(LoginStandardCommand $command)
    {
        $credentials = [
            'email' => $command->email,
            'password' => $command->password
        ];

        $expiry = $command->remember ? config('constants.expiry_week') : config('jwt.ttl');
        auth('api')->factory()->setTTL($expiry);

        $token = auth('api')->attempt($credentials);

        if(!empty($token))
        {
            $user = $this->userRepository->whereEmail($command->email)->first();

            if($user->isActive()) {
                $user->token = [
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                    'expires_in' => $expiry,
                ];

                return [
                    'user' => $user,
                    'message' => __('messages.authentication.user_login_success'),
                ];
            }else{
                JWTAuth::setToken($token)->invalidate(true);

                return [
                    'message' => __('messages.authentication.account_has_been_locked')
                ];
            }
        }else{

            return [
                'message' => __('messages.authentication.wrong_account')
            ];
        }
    }
}
