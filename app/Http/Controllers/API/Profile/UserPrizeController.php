<?php

namespace App\Http\Controllers\API\Profile;

use App\Commands\UserPrize\DestroyUserPrize\DestroyUserPrizeCommand;
use App\Commands\UserPrize\DestroyUserPrize\DestroyUserPrizeHandle;
use App\Commands\UserPrize\GetCompleteListOfUserPrize\GetCompleteListOfUserPrizeCommand;
use App\Commands\UserPrize\GetCompleteListOfUserPrize\GetCompleteListOfUserPrizeHandle;
use App\Commands\UserPrize\GetDetailListOfUserPrize\GetDetailListOfUserPrizeCommand;
use App\Commands\UserPrize\GetDetailListOfUserPrize\GetDetailListOfUserPrizeHandle;
use App\Commands\UserPrize\GetDetailListOfUserPrizeByUserSlug\GetDetailListOfUserPrizeByUserSlugCommand;
use App\Commands\UserPrize\GetDetailListOfUserPrizeByUserSlug\GetDetailListOfUserPrizeByUserSlugHandle;
use App\Commands\UserPrize\GetListPrizeCurrentUser\GetListPrizeCurrentUserCommand;
use App\Commands\UserPrize\GetListPrizeCurrentUser\GetListPrizeCurrentUserHandle;
use App\Commands\UserPrize\StoreUserPrize\StoreUserPrizeCommand;
use App\Commands\UserPrize\StoreUserPrize\StoreUserPrizeHandle;
use App\Commands\UserPrize\UpdateUserPrize\UpdateUserPrizeCommand;
use App\Commands\UserPrize\UpdateUserPrize\UpdateUserPrizeHandle;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserPrize\UserPrizeRequest;
use Illuminate\Http\JsonResponse;
use Joselfonseca\LaravelTactician\CommandBusInterface;

class UserPrizeController extends Controller
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
    public function getListPrizeCurrentUser(): JsonResponse
    {
        $this->bus->addHandler(
            GetListPrizeCurrentUserCommand::class,
            GetListPrizeCurrentUserHandle::class
        );

        $result = $this->bus->dispatch(new GetListPrizeCurrentUserCommand());

        if(!empty($result['data'])){
            return $this->responseSuccess(data: $result['data'], message: $result['message']);
        }

        return $this->responseError(
            message: $result['message'],
            error: $result['error'] ?? null,
            statusCode: $result['status_code'] ?? null
        );
    }

    /**
     * @return JsonResponse
     */
    public function getCompleteListOfUserPrize(): JsonResponse
    {
        $this->bus->addHandler(
            GetCompleteListOfUserPrizeCommand::class,
            GetCompleteListOfUserPrizeHandle::class
        );

        $result = $this->bus->dispatch(new GetCompleteListOfUserPrizeCommand());

        if(!empty($result['data'])){
            return $this->responseSuccess(data: $result['data'], message: $result['message']);
        }

        return $this->responseError(
            message: $result['message'],
            error: $result['error'] ?? null,
            statusCode: $result['status_code'] ?? null
        );
    }

    /**
     * @param UserPrizeRequest $request
     * @return JsonResponse
     */
    public function getDetailListOfUserPrize(UserPrizeRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            GetDetailListOfUserPrizeCommand::class,
            GetDetailListOfUserPrizeHandle::class
        );

        $result = $this->bus->dispatch(GetDetailListOfUserPrizeCommand::withForm($request));

        if(!empty($result['data'])){
            return $this->responseSuccess(data: $result['data'], message: $result['message']);
        }

        return $this->responseError(
            message: $result['message'],
            error: $result['error'] ?? null,
            statusCode: $result['status_code'] ?? null
        );
    }

    /**
     * @param UserPrizeRequest $request
     * @return JsonResponse
     */
    public function getDetailListOfUserPrizeByUserSlug(UserPrizeRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            GetDetailListOfUserPrizeByUserSlugCommand::class,
            GetDetailListOfUserPrizeByUserSlugHandle::class
        );

        $result = $this->bus->dispatch(GetDetailListOfUserPrizeByUserSlugCommand::withForm($request));

        if(!empty($result['data'])){
            return $this->responseSuccess(data: $result['data'], message: $result['message']);
        }

        return $this->responseError(
            message: $result['message'],
            error: $result['error'] ?? null,
            statusCode: $result['status_code'] ?? null
        );
    }

    /**
     * @param UserPrizeRequest $request
     * @return JsonResponse
     */
    public function store(UserPrizeRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            StoreUserPrizeCommand::class,
            StoreUserPrizeHandle::class
        );

        $result = $this->bus->dispatch(StoreUserPrizeCommand::withForm($request));

        if(!empty($result['data'])){
            return $this->responseSuccess(data: $result['data'], message: $result['message']);
        }

        return $this->responseError(
            message: $result['message'],
            error: $result['error'] ?? null,
            statusCode: $result['status_code'] ?? null
        );
    }

    /**
     * @param UserPrizeRequest $request
     * @return JsonResponse
     */
    public function update(UserPrizeRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            UpdateUserPrizeCommand::class,
            UpdateUserPrizeHandle::class
        );

        $result = $this->bus->dispatch(UpdateUserPrizeCommand::withForm($request));

        if(!empty($result['data'])){
            return $this->responseSuccess(data: $result['data'], message: $result['message']);
        }

        return $this->responseError(
            message: $result['message'],
            error: $result['error'] ?? null,
            statusCode: $result['status_code'] ?? null
        );
    }

    /**
     * @param UserPrizeRequest $request
     * @return JsonResponse
     */
    public function destroy(UserPrizeRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            DestroyUserPrizeCommand::class,
            DestroyUserPrizeHandle::class
        );

        $result = $this->bus->dispatch(DestroyUserPrizeCommand::withForm($request));

        if($result['userPrizeDestroy']){
            return $this->responseSuccessWithNoData(message: $result['message']);
        }

        return $this->responseError(
            message: $result['message'],
            error: $result['error'] ?? null,
            statusCode: $result['status_code'] ?? null
        );
    }
}
