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

        $token = auth('api')->attempt($credentials);

        if(auth('api')->attempt($credentials))
        {
            $user = $this->userRepository->whereEmail($command->email)->first();

            if($user->isActive()) {
                $user->token = [
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                    'expires_in' => config('jwt.ttl')
                ];
                return $user;
            }

            JWTAuth::setToken($token)->invalidate(true);
        }

        return null;
    }
}
