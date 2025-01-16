<?php

namespace App\Http\Controllers\API\Profile;

use App\Commands\UserCertification\GetListCertificationCurrentUser\GetListCertificationCurrentUserCommand;
use App\Commands\UserCertification\GetListCertificationCurrentUser\GetListCertificationCurrentUserHandle;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserCertification\CurrentUserCertificationResource;
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
}
