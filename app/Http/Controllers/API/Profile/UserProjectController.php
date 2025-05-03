<?php

namespace App\Http\Controllers\API\Profile;

use App\Commands\ProfileSeries\UserProject\DestroyUserProject\DestroyUserProjectCommand;
use App\Commands\ProfileSeries\UserProject\DestroyUserProject\DestroyUserProjectHandle;
use App\Commands\ProfileSeries\UserProject\GetCompleteListOfUserProject\GetCompleteListOfUserProjectCommand;
use App\Commands\ProfileSeries\UserProject\GetCompleteListOfUserProject\GetCompleteListOfUserProjectHandle;
use App\Commands\ProfileSeries\UserProject\GetDetailListOfUserProject\GetDetailListOfUserProjectCommand;
use App\Commands\ProfileSeries\UserProject\GetDetailListOfUserProject\GetDetailListOfUserProjectHandle;
use App\Commands\ProfileSeries\UserProject\GetDetailListOfUserProjectByUserSlug\GetDetailListOfUserProjectByUserSlugCommand;
use App\Commands\ProfileSeries\UserProject\GetDetailListOfUserProjectByUserSlug\GetDetailListOfUserProjectByUserSlugHandle;
use App\Commands\ProfileSeries\UserProject\GetListProjectCurrentUser\GetListProjectCurrentUserCommand;
use App\Commands\ProfileSeries\UserProject\GetListProjectCurrentUser\GetListProjectCurrentUserHandle;
use App\Commands\ProfileSeries\UserProject\StoreUserProject\StoreUserProjectCommand;
use App\Commands\ProfileSeries\UserProject\StoreUserProject\StoreUserProjectHandle;
use App\Commands\ProfileSeries\UserProject\UpdateUserProject\UpdateUserProjectCommand;
use App\Commands\ProfileSeries\UserProject\UpdateUserProject\UpdateUserProjectHandle;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UserProject\UserProjectRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Joselfonseca\LaravelTactician\CommandBusInterface;

class UserProjectController extends Controller
{
    public function __construct(
        protected CommandBusInterface $bus
    ) {
    }

    public function getListProjectCurrentUser(): JsonResponse
    {
        $this->bus->addHandler(
            GetListProjectCurrentUserCommand::class,
            GetListProjectCurrentUserHandle::class
        );

        $result = $this->bus->dispatch(new GetListProjectCurrentUserCommand());

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

    public function getCompleteListOfUserProject(FormRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            GetCompleteListOfUserProjectCommand::class,
            GetCompleteListOfUserProjectHandle::class
        );

        $result = $this->bus->dispatch(GetCompleteListOfUserProjectCommand::withForm($request));

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

    public function getDetailListOfUserProject(UserProjectRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            GetDetailListOfUserProjectCommand::class,
            GetDetailListOfUserProjectHandle::class
        );

        $result = $this->bus->dispatch(GetDetailListOfUserProjectCommand::withForm($request));

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

    public function getDetailListOfUserProjectByUserSlug(UserProjectRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            GetDetailListOfUserProjectByUserSlugCommand::class,
            GetDetailListOfUserProjectByUserSlugHandle::class
        );

        $result = $this->bus->dispatch(GetDetailListOfUserProjectByUserSlugCommand::withForm($request));

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

    public function store(UserProjectRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            StoreUserProjectCommand::class,
            StoreUserProjectHandle::class
        );

        $result = $this->bus->dispatch(StoreUserProjectCommand::withForm($request));

        if (! empty($result['data'])) {
            return $this->responseSuccess(data: $result['data'], message: $result['message']);
        }

        return $this->responseError(
            message: $result['message'],
            error: $result['error'] ?? null,
            statusCode: $result['status_code'] ?? null
        );
    }

    public function update(UserProjectRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            UpdateUserProjectCommand::class,
            UpdateUserProjectHandle::class
        );

        $result = $this->bus->dispatch(UpdateUserProjectCommand::withForm($request));

        if (! empty($result['data'])) {
            return $this->responseSuccess(data: $result['data'], message: $result['message']);
        }

        return $this->responseError(
            message: $result['message'],
            error: $result['error'] ?? null,
            statusCode: $result['status_code'] ?? null
        );
    }

    public function destroy(UserProjectRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            DestroyUserProjectCommand::class,
            DestroyUserProjectHandle::class
        );

        $result = $this->bus->dispatch(DestroyUserProjectCommand::withForm($request));

        if (! empty($result['userProjectDestroy'])) {
            return $this->responseSuccessWithNoData(message: $result['message']);
        }

        return $this->responseError(
            message: $result['message'],
            error: $result['error'] ?? null,
            statusCode: $result['status_code'] ?? null
        );
    }
}
