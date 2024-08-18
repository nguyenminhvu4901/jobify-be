<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest\API\LoginRequest;
use App\Services\Auth\AuthService;

class AuthController extends Controller
{
    /**
     * @var AuthService
     */
    protected AuthService $authService;

    /**
     * @param AuthService $authService
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        $user = $this->authService->login($request->all());

        return $user ? response()->json($user) : $this->responseUnauthorized();
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(): \Illuminate\Http\JsonResponse
    {
        $result = $this->authService->logout();

        if ($result) {
            return $this->responseSuccess(true, __('messages.user_is_logged_out'));
        }

        return $this->responseSuccess(false, __('messages.no_user_to_logout'));
    }
}
