<?php

namespace App\Http\Controllers\API\Auth;

use App\Commands\Auth\LoginStandard\LoginStandardCommand;
use App\Commands\Auth\LoginStandard\LoginStandardHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Auth\LoginResource;
use Joselfonseca\LaravelTactician\CommandBusInterface;

class AuthController extends Controller
{
    public function __construct(
        protected CommandBusInterface $bus)
    {
    }

    public function login(LoginRequest $request)
    {
        $this->bus->addHandler(LoginStandardCommand::class, LoginStandardHandler::class);

        $user = $this->bus->dispatch(LoginStandardCommand::withForm($request));

        return $user ?
            $this->responseSuccess(LoginResource::make($user), __('messages.user_login_success')) :
            $this->responseUnauthorized();

    }

}
