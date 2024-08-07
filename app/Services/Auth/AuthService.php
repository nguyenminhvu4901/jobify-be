<?php

namespace App\Services\Auth;

use App\Http\Resources\Auth\LoginResource;
use App\Repositories\Users\UserRepository;
use App\Services\BaseService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService extends BaseService
{
    /**
     * @var UserRepository
     */
    protected UserRepository $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login($data)
    {
        $user = $this->userRepository->searchByUsername($data['username']);

        if (!empty($user) &&
            Hash::check($data['password'], $user->password) &&
            $user->isActive()
        ) {
            $token = $user->createToken('authToken')->plainTextToken;

            $data = [
                'token' => $token,
                'user' => $user
            ];

            $dataLogin = [
                'status_code' => Response::HTTP_UNAUTHORIZED,
                'message' => __('messages.post.login.success'),
                'data' => new LoginResource($data)
            ];

        }elseif(!empty($user) &&
            Hash::check($data['password'], $user->password) &&
            $user->scopeIsDeActivate())
        {
            $dataLogin = [
                'status_code' => Response::HTTP_UNAUTHORIZED,
                'message' => ['password' => [__('messages.post.login.deactive')]],
            ];
        }elseif(!empty($user) && $user->isActive())
        {
            $dataLogin = [
                'status_code' => Response::HTTP_UNAUTHORIZED,
                'message' => ['password' => [__('messages.post.login.wrong_password')]],
            ];
        }elseif(empty($user))
        {
            $dataLogin = [
                'status_code' => Response::HTTP_UNAUTHORIZED,
                'message' => ['password' => [__('messages.post.login.wrong_username')]],
            ];
        }else{
            $dataLogin = [
                'statusCode' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => __('messages.post.login.error')
            ];
        }

        return $dataLogin;
    }

    public function logout($user)
    {
        return $user->tokens()->delete();
    }
}
