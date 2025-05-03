<?php

namespace App\Http\Controllers\API\Profile;

use App\Commands\ProfileSeries\UserActivity\DestroyUserActivity\DestroyUserActivityCommand;
use App\Commands\ProfileSeries\UserActivity\DestroyUserActivity\DestroyUserActivityHandle;
use App\Commands\ProfileSeries\UserActivity\GetCompleteListOfUserActivity\GetCompleteListOfUserActivityCommand;
use App\Commands\ProfileSeries\UserActivity\GetCompleteListOfUserActivity\GetCompleteListOfUserActivityHandle;
use App\Commands\ProfileSeries\UserActivity\GetDetailListOfUserActivity\GetDetailListOfUserActivityCommand;
use App\Commands\ProfileSeries\UserActivity\GetDetailListOfUserActivity\GetDetailListOfUserActivityHandle;
use App\Commands\ProfileSeries\UserActivity\GetDetailListOfUserActivityByUserSlug\GetDetailListOfUserActivityByUserSlugCommand;
use App\Commands\ProfileSeries\UserActivity\GetDetailListOfUserActivityByUserSlug\GetDetailListOfUserActivityByUserSlugHandle;
use App\Commands\ProfileSeries\UserActivity\GetListActivityCurrentUser\GetListActivityCurrentUserCommand;
use App\Commands\ProfileSeries\UserActivity\GetListActivityCurrentUser\GetListActivityCurrentUserHandle;
use App\Commands\ProfileSeries\UserActivity\StoreUserActivity\StoreUserActivityCommand;
use App\Commands\ProfileSeries\UserActivity\StoreUserActivity\StoreUserActivityHandle;
use App\Commands\ProfileSeries\UserActivity\UpdateUserActivity\UpdateUserActivityCommand;
use App\Commands\ProfileSeries\UserActivity\UpdateUserActivity\UpdateUserActivityHandle;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UserActivity\UserActivityRequest;
use Illuminate\Foundation\Http\FormRequest;
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

        if(!empty($result['data'])){
            return $this->responseSuccess(
                data: $result['data'],
                message: $result['message'],
                cache: $result['cache'] ?? null
            );
        }

        return $this->responseError(
            message: $result['message'],
            error: $result['error'] ?? null,
            statusCode: $result['status_code'] ?? null,
        );
    }

    /**
     * @param FormRequest $request
     * @return JsonResponse
     */
    public function getCompleteListOfUserActivity(FormRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            GetCompleteListOfUserActivityCommand::class,
            GetCompleteListOfUserActivityHandle::class
        );

        $result = $this->bus->dispatch(GetCompleteListOfUserActivityCommand::withForm($request));

        if(!empty($result['data'])){
            return $this->responseSuccess(
                data: $result['data'],
                message: $result['message'],
                cache: $result['cache'] ?? null,
                pagination: $result['pagination'] ?? null
            );
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

        if(!empty($result['data'])){

            return $this->responseSuccess(
                data: $result['data'],
                message: $result['message'],
                cache: $result['cache'] ?? null
            );
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

        if(!empty($result['data'])){
            return $this->responseSuccess(
                data: $result['data'],
                message: $result['message'],
                cache: $result['cache'] ?? null
            );
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
     * @param UserActivityRequest $request
     * @return JsonResponse
     */
    public function update(UserActivityRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            UpdateUserActivityCommand::class,
            UpdateUserActivityHandle::class
        );

        $result = $this->bus->dispatch(UpdateUserActivityCommand::withForm($request));

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
     * @param UserActivityRequest $request
     * @return JsonResponse
     */
    public function destroy(UserActivityRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            DestroyUserActivityCommand::class,
            DestroyUserActivityHandle::class
        );

        $result = $this->bus->dispatch(DestroyUserActivityCommand::withForm($request));

        if(!empty($result['userActivityDestroy'])){
            return $this->responseSuccessWithNoData(message: $result['message']);
        }

        return $this->responseError(
            message: $result['message'],
            error: $result['error'] ?? null,
            statusCode: $result['status_code'] ?? null
        );
    }
}
