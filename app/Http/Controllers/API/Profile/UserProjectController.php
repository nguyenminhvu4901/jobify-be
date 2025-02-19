<?php

namespace App\Http\Controllers\API\Profile;

use App\Commands\UserProject\DestroyUserProject\DestroyUserProjectCommand;
use App\Commands\UserProject\DestroyUserProject\DestroyUserProjectHandle;
use App\Commands\UserProject\GetCompleteListOfUserProject\GetCompleteListOfUserProjectCommand;
use App\Commands\UserProject\GetCompleteListOfUserProject\GetCompleteListOfUserProjectHandle;
use App\Commands\UserProject\GetDetailListOfUserProject\GetDetailListOfUserProjectCommand;
use App\Commands\UserProject\GetDetailListOfUserProject\GetDetailListOfUserProjectHandle;
use App\Commands\UserProject\GetDetailListOfUserProjectByUserSlug\GetDetailListOfUserProjectByUserSlugCommand;
use App\Commands\UserProject\GetDetailListOfUserProjectByUserSlug\GetDetailListOfUserProjectByUserSlugHandle;
use App\Commands\UserProject\GetListProjectCurrentUser\GetListProjectCurrentUserCommand;
use App\Commands\UserProject\GetListProjectCurrentUser\GetListProjectCurrentUserHandle;
use App\Commands\UserProject\StoreUserProject\StoreUserProjectCommand;
use App\Commands\UserProject\StoreUserProject\StoreUserProjectHandle;
use App\Commands\UserProject\UpdateUserProject\UpdateUserProjectCommand;
use App\Commands\UserProject\UpdateUserProject\UpdateUserProjectHandle;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserProject\UserProjectRequest;
use Illuminate\Http\JsonResponse;
use Joselfonseca\LaravelTactician\CommandBusInterface;

class UserProjectController extends Controller
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
    public function getListProjectCurrentUser(): JsonResponse
    {
        $this->bus->addHandler(
            GetListProjectCurrentUserCommand::class,
            GetListProjectCurrentUserHandle::class
        );

        $result = $this->bus->dispatch(new GetListProjectCurrentUserCommand());

        if(!empty($result['userProjects'])){
            return $this->responseSuccess(data: $result['userProjects'], message: $result['message']);
        }

        return $this->responseError(message: $result['message'], error: $result['error'] ?? null);
    }

    /**
     * @return JsonResponse
     */
    public function getCompleteListOfUserProject(): JsonResponse
    {
        $this->bus->addHandler(
            GetCompleteListOfUserProjectCommand::class,
            GetCompleteListOfUserProjectHandle::class
        );

        $result = $this->bus->dispatch(new GetCompleteListOfUserProjectCommand());

        if(!empty($result['userProjects'])){
            return $this->responseSuccess(data: $result['userProjects'], message: $result['message']);
        }

        return $this->responseError(message: $result['message'], error: $result['error'] ?? null);
    }

    /**
     * @param UserProjectRequest $request
     * @return JsonResponse
     */
    public function getDetailListOfUserProject(UserProjectRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            GetDetailListOfUserProjectCommand::class,
            GetDetailListOfUserProjectHandle::class
        );

        $result = $this->bus->dispatch(GetDetailListOfUserProjectCommand::withForm($request));

        if(!empty($result['userProject'])){
            return $this->responseSuccess(data: $result['userProject'], message: $result['message']);
        }

        return $this->responseError(message: $result['message'], error: $result['error'] ?? null);
    }

    /**
     * @param UserProjectRequest $request
     * @return JsonResponse
     */
    public function getDetailListOfUserProjectByUserSlug(UserProjectRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            GetDetailListOfUserProjectByUserSlugCommand::class,
            GetDetailListOfUserProjectByUserSlugHandle::class
        );

        $result = $this->bus->dispatch(GetDetailListOfUserProjectByUserSlugCommand::withForm($request));

        if(!empty($result['userProject'])){
            return $this->responseSuccess(data: $result['userProject'], message: $result['message']);
        }

        return $this->responseError(message: $result['message'], error: $result['error'] ?? null);
    }

    /**
     * @param UserProjectRequest $request
     * @return JsonResponse
     */
    public function store(UserProjectRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            StoreUserProjectCommand::class,
            StoreUserProjectHandle::class
        );

        $result = $this->bus->dispatch(StoreUserProjectCommand::withForm($request));

        if(!empty($result['userProject'])){
            return $this->responseSuccess(data: $result['userProject'], message: $result['message']);
        }

        return $this->responseError(message: $result['message'], error: $result['error'] ?? null);
    }

    /**
     * @param UserProjectRequest $request
     * @return JsonResponse
     */
    public function update(UserProjectRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            UpdateUserProjectCommand::class,
            UpdateUserProjectHandle::class
        );

        $result = $this->bus->dispatch(UpdateUserProjectCommand::withForm($request));

        if(!empty($result['userProject'])){
            return $this->responseSuccess(data: $result['userProject'], message: $result['message']);
        }

        return $this->responseError(message: $result['message'], error: $result['error'] ?? null);
    }

    /**
     * @param UserProjectRequest $request
     * @return JsonResponse
     */
    public function destroy(UserProjectRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            DestroyUserProjectCommand::class,
            DestroyUserProjectHandle::class
        );

        $result = $this->bus->dispatch(DestroyUserProjectCommand::withForm($request));

        if($result['userCourseDestroy']){
            return $this->responseSuccessWithNoData(message: $result['message']);
        }

        return $this->responseError(message: $result['message'], error: $result['error'] ?? null);
    }
}
