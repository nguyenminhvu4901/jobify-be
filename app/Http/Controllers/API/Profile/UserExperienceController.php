<?php

namespace App\Http\Controllers\API\Profile;

use App\Commands\UserExperience\DestroyUserExperience\DestroyUserExperienceCommand;
use App\Commands\UserExperience\DestroyUserExperience\DestroyUserExperienceHandler;
use App\Commands\UserExperience\GetListExperienceCurrentUser\GetListExperienceCurrentUserCommand;
use App\Commands\UserExperience\GetListExperienceCurrentUser\GetListExperienceCurrentUserHandler;
use App\Commands\UserExperience\StoreUserExperience\StoreUserExperienceCommand;
use App\Commands\UserExperience\StoreUserExperience\StoreUserExperienceHandler;
use App\Commands\UserExperience\UpdateUserExperience\UpdateUserExperienceCommand;
use App\Commands\UserExperience\UpdateUserExperience\UpdateUserExperienceHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserExperience\UserExperienceRequest;
use App\Http\Resources\UserExperience\CurrentUserExperienceResource;
use App\Http\Resources\UserExperience\UserExperienceResource;
use Illuminate\Http\JsonResponse;
use Joselfonseca\LaravelTactician\CommandBusInterface;

class UserExperienceController extends Controller
{
    /**
     * @param CommandBusInterface $bus
     */
    public function __construct(
        protected CommandBusInterface $bus
    )
    {
    }

    /**
     * @param UserExperienceRequest $request
     * @return JsonResponse
     */
    public function store(UserExperienceRequest $request): JsonResponse
    {
        $this->bus->addHandler(StoreUserExperienceCommand::class, StoreUserExperienceHandler::class);

        $userExperience = $this->bus->dispatch(StoreUserExperienceCommand::withForm($request));

        return $userExperience ?
            $this->responseSuccess(UserExperienceResource::make($userExperience),
                __('messages.user_update_profile_success')) :
            $this->responseError(__('messages.user_update_profile_error'));
    }

    /**
     * @return JsonResponse
     */
    public function getListExperienceCurrentUser(): JsonResponse
    {
        $this->bus->addHandler(GetListExperienceCurrentUserCommand::class,
            GetListExperienceCurrentUserHandler::class);

        $user = $this->bus->dispatch(new GetListExperienceCurrentUserCommand());

        return $user ?
            $this->responseSuccess(CurrentUserExperienceResource::make($user),
                __('messages.user_get_profile_success')) :
            $this->responseError(__('messages.user_get_profile_error'));
    }

    /**
     * @param UserExperienceRequest $request
     * @return JsonResponse
     */
    public function update(UserExperienceRequest $request): JsonResponse
    {
        $this->bus->addHandler(UpdateUserExperienceCommand::class, UpdateUserExperienceHandler::class);

        $userExperience = $this->bus->dispatch(UpdateUserExperienceCommand::withForm($request));

        return $userExperience ?
            $this->responseSuccess(UserExperienceResource::make($userExperience),
                __('messages.user_update_profile_success')) :
            $this->responseError(__('messages.user_update_profile_error'));
    }

    /**
     * @param UserExperienceRequest $request
     * @return JsonResponse
     */
    public function destroy(UserExperienceRequest $request): JsonResponse
    {
        $this->bus->addHandler(DestroyUserExperienceCommand::class, DestroyUserExperienceHandler::class);

        $userExperience = $this->bus->dispatch(DestroyUserExperienceCommand::withForm($request));

        return $userExperience ?
            $this->responseSuccessWithNoData(__('messages.user_destroy_profile_success')) :
            $this->responseError(__('messages.user_destroy_profile_error'));
    }
}
