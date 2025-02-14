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
use App\Http\Resources\UserSkill\CurrentUserSkillResource;
use App\Http\Resources\UserSkill\UserSkillResource;
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

        if(!empty($result['userSkills'])){
            return $this->responseSuccess(CurrentUserSkillResource::make($result['userSkills']), $result['message']);
        }

        return $this->responseError($result['message']);
    }

    /**
     * @param UserSkillRequest $request
     * @return JsonResponse
     */
    public function store(UserSkillRequest $request): JsonResponse
    {
        $this->bus->addHandler(StoreUserSkillCommand::class, StoreUserSkillHandle::class);

        $result = $this->bus->dispatch(StoreUserSkillCommand::withForm($request));

        if(!empty($result['userSkill'])){
            return $this->responseSuccess(UserSkillResource::make($result['userSkill']), $result['message']);
        }

        return $this->responseError($result['message']);
    }

    /**
     * @return JsonResponse
     */
    public function getCompleteListOfUserSkill(): JsonResponse
    {
        $this->bus->addHandler(GetCompleteListOfUserSkillCommand::class, GetCompleteListOfUserSkillHandle::class);

        $result = $this->bus->dispatch(new GetCompleteListOfUserSkillCommand());

        if(!empty($result['userSkills'])){
            return $this->responseSuccess(UserSkillResource::collection($result['userSkills']), $result['message']);
        }

        return $this->responseError($result['message']);
    }

    public function getDetailListOfUserSkill(UserSkillRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            GetDetailListOfUserSkillCommand::class,
            GetDetailListOfUserSkillHandle::class
        );

        $result = $this->bus->dispatch(GetDetailListOfUserSkillCommand::withForm($request));

        if(!empty($result['userSkill'])){
            return $this->responseSuccess(UserSkillResource::make($result['userSkill']), $result['message']);
        }

        return $this->responseError($result['message']);
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

        if(!empty($result['userSkills'])){
            return $this->responseSuccess(UserSkillResource::collection($result['userSkills']), $result['message']);
        }

        return $this->responseError($result['message']);
    }

    public function update(UserSkillRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            UpdateUserSkillCommand::class,
            UpdateUserSkillHandle::class
        );

        $result = $this->bus->dispatch(UpdateUserSkillCommand::withForm($request));

        if(!empty($result['userSkill'])){
            return $this->responseSuccess(UserSkillResource::make($result['userSkill']), $result['message']);
        }

        return $this->responseError($result['message']);
    }

    public function destroy(UserSkillRequest $request): JsonResponse
    {
        $this->bus->addHandler(DestroyUserSkillCommand::class, DestroyUserSkillHandle::class);

        $result = $this->bus->dispatch(DestroyUserSkillCommand::withForm($request));

        if(!empty($result['userSkill'])){
            return $this->responseSuccessWithNoData($result['message']);
        }

        return $this->responseError($result['message'], $result['status_code']);
    }
}
