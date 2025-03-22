<?php

namespace App\Http\Controllers\API\Profile;

use App\Commands\Profile\UserSkill\DestroyUserSkill\DestroyUserSkillCommand;
use App\Commands\Profile\UserSkill\DestroyUserSkill\DestroyUserSkillHandle;
use App\Commands\Profile\UserSkill\GetCompleteListOfUserSkill\GetCompleteListOfUserSkillCommand;
use App\Commands\Profile\UserSkill\GetCompleteListOfUserSkill\GetCompleteListOfUserSkillHandle;
use App\Commands\Profile\UserSkill\GetDetailListOfUserSkill\GetDetailListOfUserSkillCommand;
use App\Commands\Profile\UserSkill\GetDetailListOfUserSkill\GetDetailListOfUserSkillHandle;
use App\Commands\Profile\UserSkill\GetDetailListOfUserSkillByUserSlug\GetDetailListOfUserSkillByUserSlugCommand;
use App\Commands\Profile\UserSkill\GetDetailListOfUserSkillByUserSlug\GetDetailListOfUserSkillByUserSlugHandle;
use App\Commands\Profile\UserSkill\GetListSkillCurrentUser\GetListSkillCurrentUserCommand;
use App\Commands\Profile\UserSkill\GetListSkillCurrentUser\GetListSkillCurrentUserHandle;
use App\Commands\Profile\UserSkill\StoreUserSkill\StoreUserSkillCommand;
use App\Commands\Profile\UserSkill\StoreUserSkill\StoreUserSkillHandle;
use App\Commands\Profile\UserSkill\UpdateUserSkill\UpdateUserSkillCommand;
use App\Commands\Profile\UserSkill\UpdateUserSkill\UpdateUserSkillHandle;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UserSkill\UserSkillRequest;
use Illuminate\Foundation\Http\FormRequest;
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
     * @param FormRequest $request
     * @return JsonResponse
     */
    public function getCompleteListOfUserSkill(FormRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            GetCompleteListOfUserSkillCommand::class,
            GetCompleteListOfUserSkillHandle::class
        );

        $result = $this->bus->dispatch(GetCompleteListOfUserSkillCommand::withForm($request));

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
