<?php

namespace App\Http\Controllers\API\Profile;

use App\Commands\UserSkill\DestroyUserSkill\DestroyUserSkillCommand;
use App\Commands\UserSkill\DestroyUserSkill\DestroyUserSkillHandle;
use App\Commands\UserSkill\GetCompleteListOfUserSkill\GetCompleteListOfUserSkillCommand;
use App\Commands\UserSkill\GetCompleteListOfUserSkill\GetCompleteListOfUserSkillHandle;
use App\Commands\UserSkill\GetDetailListOfUserSkill\GetDetailListOfUserSkillCommand;
use App\Commands\UserSkill\GetDetailListOfUserSkill\GetDetailListOfUserSkillHandle;
use App\Commands\UserSkill\GetDetailListOfUserSkillByUserSlug\GetDetailListOfUserSkillByUserSlugCommand;
use App\Commands\UserSkill\GetDetailListOfUserSkillByUserSlug\GetDetailListOfUserSkillByUserSlugHandle;
use App\Commands\UserSkill\GetListSkillCurrentUser\GetListSkillCurrentUserCommand;
use App\Commands\UserSkill\GetListSkillCurrentUser\GetListSkillCurrentUserHandle;
use App\Commands\UserSkill\StoreUserSkill\StoreUserSkillCommand;
use App\Commands\UserSkill\StoreUserSkill\StoreUserSkillHandle;
use App\Commands\UserSkill\UpdateUserSkill\UpdateUserSkillCommand;
use App\Commands\UserSkill\UpdateUserSkill\UpdateUserSkillHandle;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserSkill\UserSkillRequest;
use Illuminate\Http\JsonResponse;
use Joselfonseca\LaravelTactician\CommandBusInterface;

class UserSkillController extends Controller
{
    public function __construct(
        protected CommandBusInterface $bus
    )
    {
    }

    /**
     * @return JsonResponse
     */
    public function getListSkillCurrentUser(): JsonResponse
    {
        $this->bus->addHandler(GetListSkillCurrentUserCommand::class, GetListSkillCurrentUserHandle::class);

        $result = $this->bus->dispatch(new GetListSkillCurrentUserCommand());

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
     * @param UserSkillRequest $request
     * @return JsonResponse
     */
    public function store(UserSkillRequest $request): JsonResponse
    {
        $this->bus->addHandler(StoreUserSkillCommand::class, StoreUserSkillHandle::class);

        $result = $this->bus->dispatch(StoreUserSkillCommand::withForm($request));

        if(!empty($result['data'])){
            return $this->responseSuccess(
                data: $result['data'],
                message: $result['message']
            );
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
    public function getCompleteListOfUserSkill(): JsonResponse
    {
        $this->bus->addHandler(
            GetCompleteListOfUserSkillCommand::class,
            GetCompleteListOfUserSkillHandle::class
        );

        $result = $this->bus->dispatch(new GetCompleteListOfUserSkillCommand());

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

    public function getDetailListOfUserSkill(UserSkillRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            GetDetailListOfUserSkillCommand::class,
            GetDetailListOfUserSkillHandle::class
        );

        $result = $this->bus->dispatch(GetDetailListOfUserSkillCommand::withForm($request));

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
     * @param UserSkillRequest $request
     * @return JsonResponse
     */
    public function getDetailListOfUserSkillByUserSlug(UserSkillRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            GetDetailListOfUserSkillByUserSlugCommand::class,
            GetDetailListOfUserSkillByUserSlugHandle::class
        );

        $result = $this->bus->dispatch(GetDetailListOfUserSkillByUserSlugCommand::withForm($request));

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

    public function update(UserSkillRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            UpdateUserSkillCommand::class,
            UpdateUserSkillHandle::class
        );

        $result = $this->bus->dispatch(UpdateUserSkillCommand::withForm($request));

        if(!empty($result['data'])){
            return $this->responseSuccess(data: $result['data'], message: $result['message']);
        }

        return $this->responseError(
            message: $result['message'],
            error: $result['error'] ?? null,
            statusCode: $result['status_code'] ?? null
        );
    }

    public function destroy(UserSkillRequest $request): JsonResponse
    {
        $this->bus->addHandler(DestroyUserSkillCommand::class, DestroyUserSkillHandle::class);

        $result = $this->bus->dispatch(DestroyUserSkillCommand::withForm($request));

        if(!empty($result['userSkillDestroy'])){
            return $this->responseSuccessWithNoData(message: $result['message']);
        }

        return $this->responseError(
            message: $result['message'],
            error: $result['error'] ?? null,
            statusCode: $result['status_code'] ?? null
        );
    }
}
