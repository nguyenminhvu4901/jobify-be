<?php

namespace App\Http\Controllers\API\Profile;

use App\Commands\UserSkill\GetListSkillCurrentUser\GetListSkillCurrentUserCommand;
use App\Commands\UserSkill\GetListSkillCurrentUser\GetListSkillCurrentUserHandle;
use App\Commands\UserSkill\StoreUserSkill\StoreUserSkillCommand;
use App\Commands\UserSkill\StoreUserSkill\StoreUserSkillHandle;
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
}
