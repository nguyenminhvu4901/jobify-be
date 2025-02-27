<?php

namespace App\Http\Controllers\API\Profile;

use App\Commands\UserCourse\DestroyUserCourse\DestroyUserCourseCommand;
use App\Commands\UserCourse\DestroyUserCourse\DestroyUserCourseHandle;
use App\Commands\UserCourse\GetCompleteListOfUserCourse\GetCompleteListOfUserCourseCommand;
use App\Commands\UserCourse\GetCompleteListOfUserCourse\GetCompleteListOfUserCourseHandle;
use App\Commands\UserCourse\GetDetailListOfUserCourse\GetDetailListOfUserCourseCommand;
use App\Commands\UserCourse\GetDetailListOfUserCourse\GetDetailListOfUserCourseHandle;
use App\Commands\UserCourse\GetDetailListOfUserCourseByUserSlug\GetDetailListOfUserCourseByUserSlugCommand;
use App\Commands\UserCourse\GetDetailListOfUserCourseByUserSlug\GetDetailListOfUserCourseByUserSlugHandle;
use App\Commands\UserCourse\GetListCourseCurrentUser\GetListCourseCurrentUserCommand;
use App\Commands\UserCourse\GetListCourseCurrentUser\GetListCourseCurrentUserHandle;
use App\Commands\UserCourse\StoreUserCourse\StoreUserCourseCommand;
use App\Commands\UserCourse\StoreUserCourse\StoreUserCourseHandle;
use App\Commands\UserCourse\UpdateUserCourse\UpdateUserCourseCommand;
use App\Commands\UserCourse\UpdateUserCourse\UpdateUserCourseHandle;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserCourse\UserCourseRequest;
use Illuminate\Http\JsonResponse;
use Joselfonseca\LaravelTactician\CommandBusInterface;

class UserCourseController extends Controller
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
    public function getListCourseCurrentUser(): JsonResponse
    {
        $this->bus->addHandler(GetListCourseCurrentUserCommand::class,
            GetListCourseCurrentUserHandle::class);

        $result = $this->bus->dispatch(new GetListCourseCurrentUserCommand());

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
     * @return JsonResponse
     */
    public function getCompleteListOfUserCourse(): JsonResponse
    {
        $this->bus->addHandler(
            GetCompleteListOfUserCourseCommand::class,
            GetCompleteListOfUserCourseHandle::class
        );

        $result = $this->bus->dispatch(new GetCompleteListOfUserCourseCommand());

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
     * @param UserCourseRequest $request
     * @return JsonResponse
     */
    public function getDetailListOfUserCourse(UserCourseRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            GetDetailListOfUserCourseCommand::class,
            GetDetailListOfUserCourseHandle::class
        );

        $result = $this->bus->dispatch(GetDetailListOfUserCourseCommand::withForm($request));

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
     * @param UserCourseRequest $request
     * @return JsonResponse
     */
    public function getDetailListOfUserCourseByUserSlug(UserCourseRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            GetDetailListOfUserCourseByUserSlugCommand::class,
            GetDetailListOfUserCourseByUserSlugHandle::class
        );

        $result = $this->bus->dispatch(GetDetailListOfUserCourseByUserSlugCommand::withForm($request));

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
     * @param UserCourseRequest $request
     * @return JsonResponse
     */
    public function store(UserCourseRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            StoreUserCourseCommand::class,
            StoreUserCourseHandle::class
        );

        $result = $this->bus->dispatch(StoreUserCourseCommand::withForm($request));

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
     * @param UserCourseRequest $request
     * @return JsonResponse
     */
    public function update(UserCourseRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            UpdateUserCourseCommand::class,
            UpdateUserCourseHandle::class
        );

        $result = $this->bus->dispatch(UpdateUserCourseCommand::withForm($request));

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
     * @param UserCourseRequest $request
     * @return JsonResponse
     */
    public function destroy(UserCourseRequest $request): JsonResponse
    {
        $this->bus->addHandler(DestroyUserCourseCommand::class, DestroyUserCourseHandle::class);

        $result = $this->bus->dispatch(DestroyUserCourseCommand::withForm($request));

        if($result['userCourseDestroy']){
            return $this->responseSuccessWithNoData(message: $result['message']);
        }

        return $this->responseError(
            message: $result['message'],
            error: $result['error'] ?? null,
            statusCode: $result['status_code'] ?? null
        );
    }
}
