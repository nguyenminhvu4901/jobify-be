<?php

namespace App\Http\Controllers\API\Profile;

use App\Commands\UserActivity\DestroyUserActivity\DestroyUserActivityCommand;
use App\Commands\UserActivity\DestroyUserActivity\DestroyUserActivityHandle;
use App\Commands\UserActivity\GetCompleteListOfUserActivity\GetCompleteListOfUserActivityCommand;
use App\Commands\UserActivity\GetCompleteListOfUserActivity\GetCompleteListOfUserActivityHandle;
use App\Commands\UserActivity\GetDetailListOfUserActivity\GetDetailListOfUserActivityCommand;
use App\Commands\UserActivity\GetDetailListOfUserActivity\GetDetailListOfUserActivityHandle;
use App\Commands\UserActivity\GetDetailListOfUserActivityByUserSlug\GetDetailListOfUserActivityByUserSlugCommand;
use App\Commands\UserActivity\GetDetailListOfUserActivityByUserSlug\GetDetailListOfUserActivityByUserSlugHandle;
use App\Commands\UserActivity\GetListActivityCurrentUser\GetListActivityCurrentUserCommand;
use App\Commands\UserActivity\GetListActivityCurrentUser\GetListActivityCurrentUserHandle;
use App\Commands\UserActivity\StoreUserActivity\StoreUserActivityCommand;
use App\Commands\UserActivity\StoreUserActivity\StoreUserActivityHandle;
use App\Commands\UserActivity\UpdateUserActivity\UpdateUserActivityCommand;
use App\Commands\UserActivity\UpdateUserActivity\UpdateUserActivityHandle;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserActivity\UserActivityRequest;
use App\Http\Requests\UserProduct\UserProductRequest;
use Illuminate\Http\JsonResponse;
use Joselfonseca\LaravelTactician\CommandBusInterface;

class UserActivityController extends Controller
{
    public function __construct(
        protected CommandBusInterface $bus
    )
    {
    }

    /**
     * @return JsonResponse
     */
    public function getListActivityCurrentUser(): JsonResponse
    {
        $this->bus->addHandler(
            GetListActivityCurrentUserCommand::class,
            GetListActivityCurrentUserHandle::class
        );

        $result = $this->bus->dispatch(new GetListActivityCurrentUserCommand());

        if(!empty($result['userActivities'])){
            return $this->responseSuccess(data: $result['userActivities'], message: $result['message']);
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
    public function getCompleteListOfUserActivity(): JsonResponse
    {
        $this->bus->addHandler(
            GetCompleteListOfUserActivityCommand::class,
            GetCompleteListOfUserActivityHandle::class
        );

        $result = $this->bus->dispatch(new GetCompleteListOfUserActivityCommand());

        if(!empty($result['userActivities'])){
            return $this->responseSuccess(data: $result['userActivities'], message: $result['message']);
        }

        return $this->responseError(
            message: $result['message'],
            error: $result['error'] ?? null,
            statusCode: $result['status_code'] ?? null
        );
    }

    /**
     * @param UserActivityRequest $request
     * @return JsonResponse
     */
    public function getDetailListOfUserActivity(UserActivityRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            GetDetailListOfUserActivityCommand::class,
            GetDetailListOfUserActivityHandle::class
        );

        $result = $this->bus->dispatch(GetDetailListOfUserActivityCommand::withForm($request));

        if(!empty($result['userActivity'])){
            return $this->responseSuccess(data: $result['userActivity'], message: $result['message']);
        }

        return $this->responseError(
            message: $result['message'],
            error: $result['error'] ?? null,
            statusCode: $result['status_code'] ?? null
        );
    }

    /**
     * @param UserActivityRequest $request
     * @return JsonResponse
     */
    public function getDetailListOfUserActivityByUserSlug(UserActivityRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            GetDetailListOfUserActivityByUserSlugCommand::class,
            GetDetailListOfUserActivityByUserSlugHandle::class
        );

        $result = $this->bus->dispatch(GetDetailListOfUserActivityByUserSlugCommand::withForm($request));

        if(!empty($result['userActivity'])){
            return $this->responseSuccess(data: $result['userActivity'], message: $result['message']);
        }

        return $this->responseError(
            message: $result['message'],
            error: $result['error'] ?? null,
            statusCode: $result['status_code'] ?? null
        );
    }

    /**
     * @param UserActivityRequest $request
     * @return JsonResponse
     */
    public function store(UserActivityRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            StoreUserActivityCommand::class,
            StoreUserActivityHandle::class
        );

        $result = $this->bus->dispatch(StoreUserActivityCommand::withForm($request));

        if(!empty($result['userActivity'])){
            return $this->responseSuccess(data: $result['userActivity'], message: $result['message']);
        }

        return $this->responseError(
            message: $result['message'],
            error: $result['error'] ?? null,
            statusCode: $result['status_code'] ?? null
        );
    }

    /**
     * @param UserProductRequest $request
     * @return JsonResponse
     */
    public function update(UserProductRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            UpdateUserActivityCommand::class,
            UpdateUserActivityHandle::class
        );

        $result = $this->bus->dispatch(UpdateUserActivityCommand::withForm($request));

        if(!empty($result['userActivity'])){
            return $this->responseSuccess(data: $result['userActivity'], message: $result['message']);
        }

        return $this->responseError(
            message: $result['message'],
            error: $result['error'] ?? null,
            statusCode: $result['status_code'] ?? null
        );
    }

    /**
     * @param UserProductRequest $request
     * @return JsonResponse
     */
    public function destroy(UserProductRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            DestroyUserActivityCommand::class,
            DestroyUserActivityHandle::class
        );

        $result = $this->bus->dispatch(DestroyUserActivityCommand::withForm($request));

        if($result['userActivityDestroy']){
            return $this->responseSuccessWithNoData(message: $result['message']);
        }

        return $this->responseError(
            message: $result['message'],
            error: $result['error'] ?? null,
            statusCode: $result['status_code'] ?? null
        );
    }
}
