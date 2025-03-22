<?php

namespace App\Http\Controllers\API\Profile;

use App\Commands\Profile\UserLocation\DestroyUserLocation\DestroyUserLocationCommand;
use App\Commands\Profile\UserLocation\DestroyUserLocation\DestroyUserRequestHandle;
use App\Commands\Profile\UserLocation\GetCompleteListOfUserLocation\GetCompleteListOfUserLocationCommand;
use App\Commands\Profile\UserLocation\GetCompleteListOfUserLocation\GetCompleteListOfUserLocationHandle;
use App\Commands\Profile\UserLocation\GetDetailListOfUserLocation\GetDetailListOfUserLocationCommand;
use App\Commands\Profile\UserLocation\GetDetailListOfUserLocation\GetDetailListOfUserLocationHandle;
use App\Commands\Profile\UserLocation\GetDetailListOfUserLocationByUserSlug\GetDetailListOfUserLocationByUserSlugCommand;
use App\Commands\Profile\UserLocation\GetDetailListOfUserLocationByUserSlug\GetDetailListOfUserLocationByUserSlugHandle;
use App\Commands\Profile\UserLocation\GetListLocationCurrentUser\GetListLocationCurrentUserCommand;
use App\Commands\Profile\UserLocation\GetListLocationCurrentUser\GetListLocationCurrentUserHandle;
use App\Commands\Profile\UserLocation\StoreUserLocation\StoreUserLocationCommand;
use App\Commands\Profile\UserLocation\StoreUserLocation\StoreUserLocationHandle;
use App\Commands\Profile\UserLocation\UpdateUserLocation\UpdateUserLocationCommand;
use App\Commands\Profile\UserLocation\UpdateUserLocation\UpdateUserLocationHandle;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UserLocation\UserLocationRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Joselfonseca\LaravelTactician\CommandBusInterface;

class UserLocationController extends Controller
{
    public function __construct(
        protected CommandBusInterface $bus
    )
    {
    }

    /**
     * @return JsonResponse
     */
    public function getListLocationCurrentUser(): JsonResponse
    {
        $this->bus->addHandler(
            GetListLocationCurrentUserCommand::class,
            GetListLocationCurrentUserHandle::class
        );

        $result = $this->bus->dispatch(new GetListLocationCurrentUserCommand());

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
     * @param UserLocationRequest $request
     * @return JsonResponse
     */
    public function store(UserLocationRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            StoreUserLocationCommand::class,
            StoreUserLocationHandle::class
        );

        $result = $this->bus->dispatch(StoreUserLocationCommand::withForm($request));

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
     * @param FormRequest $request
     * @return JsonResponse
     */
    public function getCompleteListOfUserLocation(FormRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            GetCompleteListOfUserLocationCommand::class,
            GetCompleteListOfUserLocationHandle::class
        );

        $result = $this->bus->dispatch(GetCompleteListOfUserLocationCommand::withForm($request));

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

    public function getDetailListOfUserLocation(UserLocationRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            GetDetailListOfUserLocationCommand::class,
            GetDetailListOfUserLocationHandle::class
        );

        $result = $this->bus->dispatch(GetDetailListOfUserLocationCommand::withForm($request));

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
     * @param UserLocationRequest $request
     * @return JsonResponse
     */
    public function getDetailListOfUserLocationByUserSlug(UserLocationRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            GetDetailListOfUserLocationByUserSlugCommand::class,
            GetDetailListOfUserLocationByUserSlugHandle::class
        );

        $result = $this->bus->dispatch(GetDetailListOfUserLocationByUserSlugCommand::withForm($request));

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

    public function update(UserLocationRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            UpdateUserLocationCommand::class,
            UpdateUserLocationHandle::class
        );

        $result = $this->bus->dispatch(
            UpdateUserLocationCommand::withForm($request)
        );

        if(!empty($result['data'])){
            return $this->responseSuccess(data: $result['data'], message: $result['message']);
        }

        return $this->responseError(
            message: $result['message'],
            error: $result['error'] ?? null,
            statusCode: $result['status_code'] ?? null
        );
    }

    public function destroy(UserLocationRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            DestroyUserLocationCommand::class,
            DestroyUserRequestHandle::class
        );

        $result = $this->bus->dispatch(DestroyUserLocationCommand::withForm($request));

        if(!empty($result['userLocationDestroy'])){
            return $this->responseSuccessWithNoData(message: $result['message']);
        }

        return $this->responseError(
            message: $result['message'],
            error: $result['error'] ?? null,
            statusCode: $result['status_code'] ?? null
        );
    }
}
