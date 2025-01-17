<?php

namespace App\Http\Controllers\API\Profile;

use App\Commands\UserCertification\GetCompleteListOfUserCertification\GetCompleteListOfUserCertificationCommand;
use App\Commands\UserCertification\GetCompleteListOfUserCertification\GetCompleteListOfUserCertificationHandle;
use App\Commands\UserCertification\GetListCertificationCurrentUser\GetListCertificationCurrentUserCommand;
use App\Commands\UserCertification\GetListCertificationCurrentUser\GetListCertificationCurrentUserHandle;
use App\Commands\UserCertification\StoreUserCertification\StoreUserCertificationCommand;
use App\Commands\UserCertification\StoreUserCertification\StoreUserCertificationHandle;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserCertification\UserCertificationRequest;
use App\Http\Resources\UserCertification\CurrentUserCertificationResource;
use App\Http\Resources\UserCertification\UserCertificationResource;
use Illuminate\Http\JsonResponse;
use Joselfonseca\LaravelTactician\CommandBusInterface;

class UserCertificationController extends Controller
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
     * @return JsonResponse
     */
    public function getListCertificationCurrentUser(): JsonResponse
    {
        $this->bus->addHandler(
            GetListCertificationCurrentUserCommand::class,
            GetListCertificationCurrentUserHandle::class
        );

        $user = $this->bus->dispatch(new GetListCertificationCurrentUserCommand());

        return $user ?
            $this->responseSuccess(CurrentUserCertificationResource::make($user),
                __('messages.user_get_profile_success')) :
            $this->responseError(__('messages.user_get_profile_error'));
    }

    /**
     * @param UserCertificationRequest $request
     * @return JsonResponse
     */
    public function store(UserCertificationRequest $request): JsonResponse
    {
        $this->bus->addHandler(StoreUserCertificationCommand::class, StoreUserCertificationHandle::class);

        $userCertification = $this->bus->dispatch(StoreUserCertificationCommand::withForm($request));

        return $userCertification ?
            $this->responseSuccess(UserCertificationResource::make($userCertification),
                __('messages.user_update_profile_success')) :
            $this->responseError(__('messages.user_update_profile_error'));
    }

    /**
     * @return JsonResponse
     */
    public function getCompleteListOfUserCertification(): JsonResponse
    {
        $this->bus->addHandler(
            GetCompleteListOfUserCertificationCommand::class,
            GetCompleteListOfUserCertificationHandle::class
        );

        $userCertifications = $this->bus->dispatch(new GetCompleteListOfUserCertificationCommand());

        return $userCertifications ?
            $this->responseSuccess(UserCertificationResource::collection($userCertifications),
                __('messages.user_update_profile_success')) :
            $this->responseError(__('messages.user_update_profile_error'));
    }
}
