<?php

namespace App\Http\Controllers\API\Auth;

use App\Commands\Auth\LoginStandard\LoginStandardCommand;
use App\Commands\Auth\LoginStandard\LoginStandardHandler;
use App\Commands\Auth\Logout\LogoutCommand;
use App\Commands\Auth\Logout\LogoutHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Auth\LoginResource;
use Illuminate\Http\JsonResponse;
use Joselfonseca\LaravelTactician\CommandBusInterface;

/**
 *
 */
class AuthController extends Controller
{
    /**
     * @param CommandBusInterface $bus
     */
    public function __construct(
        protected CommandBusInterface $bus)
    {
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $this->bus->addHandler(LoginStandardCommand::class, LoginStandardHandler::class);

        $user = $this->bus->dispatch(LoginStandardCommand::withForm($request));

        return $user ?
            $this->responseSuccess(LoginResource::make($user), __('messages.user_login_success')) :
            $this->responseError();
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        $this->bus->addHandler(LogoutCommand::class, LogoutHandler::class);

        $result = $this->bus->dispatch(new LogoutCommand(request()->bearerToken()));

        return $result ?
            $this->responseSuccessWithNoData(__('messages.user_is_logged_out')) :
            $this->responseInternalServerError();
    }
}
