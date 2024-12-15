<?php

namespace App\Http\Controllers\API\Auth;

use App\Commands\Auth\JobSeekerRegister\JobSeekerRegisterCommand;
use App\Commands\Auth\JobSeekerRegister\JobSeekerRegisterHandler;
use App\Commands\Auth\LoginStandard\LoginStandardCommand;
use App\Commands\Auth\LoginStandard\LoginStandardHandler;
use App\Commands\Auth\Logout\LogoutCommand;
use App\Commands\Auth\Logout\LogoutHandler;
use App\Commands\Auth\RecruiterRegister\RecruiterCommand;
use App\Commands\Auth\RecruiterRegister\RecruiterHandler;
use App\Commands\Auth\ResetPassword\ResetPasswordCommand;
use App\Commands\Auth\ResetPassword\ResetPasswordHandler;
use App\Commands\Auth\SendForgotPassword\SendForgotPasswordCommand;
use App\Commands\Auth\SendForgotPassword\SendForgotPasswordHandler;
use App\Commands\Auth\UserChangePassword\UserChangePasswordCommand;
use App\Commands\Auth\UserChangePassword\UserChangePasswordHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\JobSeekerRegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RecruiterRegisterRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\UserChangePassword;
use App\Http\Resources\Auth\JobSeekerRegisterResource;
use App\Http\Resources\Auth\LoginResource;
use App\Http\Resources\Auth\RecruiterRegisterResource;
use App\Http\Resources\Auth\UserChangePasswordResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
            $this->responseUnauthorized(__('messages.user_login_error'));
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

    /**
     * @param JobSeekerRegisterRequest $request
     * @return JsonResponse
     */
    public function jobSeekerRegister(JobSeekerRegisterRequest $request): JsonResponse
    {
        $this->bus->addHandler(JobSeekerRegisterCommand::class, JobSeekerRegisterHandler::class);

        $jobSeeker = $this->bus->dispatch(JobSeekerRegisterCommand::withForm($request));

        return $jobSeeker ?
            $this->responseSuccess(JobSeekerRegisterResource::make($jobSeeker),
                __('messages.user_register_success')) :
            $this->responseError(__('messages.user_register_error'));
    }

    /**
     * @param RecruiterRegisterRequest $request
     * @return JsonResponse
     */
    public function recruiterRegister(RecruiterRegisterRequest $request): JsonResponse
    {
        $this->bus->addHandler(RecruiterCommand::class, RecruiterHandler::class);

        $recruiter = $this->bus->dispatch(RecruiterCommand::withForm($request));

        return $recruiter ?
            $this->responseSuccess(RecruiterRegisterResource::make($recruiter), __('messages.user_register_success')) :
            $this->responseError(__('messages.user_register_error'));
    }

    public function changePassword(UserChangePassword $request): JsonResponse
    {
        $this->bus->addHandler(UserChangePasswordCommand::class, UserChangePasswordHandler::class);

        $user = $this->bus->dispatch(UserChangePasswordCommand::withForm($request));

        return $user ?
            $this->responseSuccess(UserChangePasswordResource::make($user), __('messages.user_change_password_success')) :
            $this->responseError(__('messages.user_change_password_error'));
    }

    public function sendForgotPassword(ForgotPasswordRequest $request): JsonResponse
    {
        $this->bus->addHandler(SendForgotPasswordCommand::class, SendForgotPasswordHandler::class);

        $data = $this->bus->dispatch(SendForgotPasswordCommand::withForm($request));

        return $data ?
            $this->responseSuccess("", $data) :
            $this->responseError();
    }

    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        $this->bus->addHandler(ResetPasswordCommand::class, ResetPasswordHandler::class);

        $data = $this->bus->dispatch(ResetPasswordCommand::withForm($request));

        return $data ?
            $this->responseSuccess("", $data) :
            $this->responseError();
    }

    /**
     * @return JsonResponse
     */
    public function unauthorized(): JsonResponse
    {
        return $this->responseUnauthorized();
    }
}
