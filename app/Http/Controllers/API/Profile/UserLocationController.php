<?php

namespace App\Http\Controllers\API\Profile;

use App\Commands\ProfileSeries\UserLocation\DestroyUserLocation\DestroyUserLocationCommand;
use App\Commands\ProfileSeries\UserLocation\DestroyUserLocation\DestroyUserRequestHandle;
use App\Commands\ProfileSeries\UserLocation\GetCompleteListOfUserLocation\GetCompleteListOfUserLocationCommand;
use App\Commands\ProfileSeries\UserLocation\GetCompleteListOfUserLocation\GetCompleteListOfUserLocationHandle;
use App\Commands\ProfileSeries\UserLocation\GetDetailListOfUserLocation\GetDetailListOfUserLocationCommand;
use App\Commands\ProfileSeries\UserLocation\GetDetailListOfUserLocation\GetDetailListOfUserLocationHandle;
use App\Commands\ProfileSeries\UserLocation\GetDetailListOfUserLocationByUserSlug\GetDetailListOfUserLocationByUserSlugCommand;
use App\Commands\ProfileSeries\UserLocation\GetDetailListOfUserLocationByUserSlug\GetDetailListOfUserLocationByUserSlugHandle;
use App\Commands\ProfileSeries\UserLocation\GetListLocationCurrentUser\GetListLocationCurrentUserCommand;
use App\Commands\ProfileSeries\UserLocation\GetListLocationCurrentUser\GetListLocationCurrentUserHandle;
use App\Commands\ProfileSeries\UserLocation\StoreUserLocation\StoreUserLocationCommand;
use App\Commands\ProfileSeries\UserLocation\StoreUserLocation\StoreUserLocationHandle;
use App\Commands\ProfileSeries\UserLocation\UpdateUserLocation\UpdateUserLocationCommand;
use App\Commands\ProfileSeries\UserLocation\UpdateUserLocation\UpdateUserLocationHandle;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UserLocation\UserLocationRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Joselfonseca\LaravelTactician\CommandBusInterface;

class UserLocationController extends Controller
{
    public function __construct(
        protected CommandBusInterface $bus
    ) {
    }

    public function getListLocationCurrentUser(): JsonResponse
    {
        $this->bus->addHandler(
            GetListLocationCurrentUserCommand::class,
            GetListLocationCurrentUserHandle::class
        );

        $result = $this->bus->dispatch(new GetListLocationCurrentUserCommand());

        if (! empty($result['data'])) {
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

    public function store(UserLocationRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            StoreUserLocationCommand::class,
            StoreUserLocationHandle::class
        );

        $result = $this->bus->dispatch(StoreUserLocationCommand::withForm($request));

        if (! empty($result['data'])) {
            return $this->responseSuccess(data: $result['data'], message: $result['message']);
        }

        return $this->responseError(
            message: $result['message'],
            error: $result['error'] ?? null,
            statusCode: $result['status_code'] ?? null
        );
    }

    public function getCompleteListOfUserLocation(FormRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            GetCompleteListOfUserLocationCommand::class,
            GetCompleteListOfUserLocationHandle::class
        );

        $result = $this->bus->dispatch(GetCompleteListOfUserLocationCommand::withForm($request));

        if (! empty($result['data'])) {

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

        if (! empty($result['data'])) {
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

    public function getDetailListOfUserLocationByUserSlug(UserLocationRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            GetDetailListOfUserLocationByUserSlugCommand::class,
            GetDetailListOfUserLocationByUserSlugHandle::class
        );

        $result = $this->bus->dispatch(GetDetailListOfUserLocationByUserSlugCommand::withForm($request));

        if (! empty($result['data'])) {
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

        if (! empty($result['data'])) {
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

        if (! empty($result['userLocationDestroy'])) {
            return $this->responseSuccessWithNoData(message: $result['message']);
        }

        return $this->responseError(
            message: $result['message'],
            error: $result['error'] ?? null,
            statusCode: $result['status_code'] ?? null
        );
    }
}
