<?php

namespace App\Services\Auth;

use App\Http\Resources\Auth\LoginResource;
use App\Repositories\Users\UserRepository;
use App\Services\BaseService;
use Illuminate\Http\Response;
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

    /**
     * @param $data
     * @return array
     */
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
                'status_code' => Response::HTTP_OK,
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

    /**
     * @return bool
     */
    public function logout(): bool
    {
        if ($user = auth()->user()) {
            $user->tokens()->delete();
            return true;
        }

        return false;
    }
}
