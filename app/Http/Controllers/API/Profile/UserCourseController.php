<?php

namespace App\Http\Controllers\API\Profile;

use App\Commands\UserCourse\GetCompleteListOfUserCourse\GetCompleteListOfUserCourseCommand;
use App\Commands\UserCourse\GetCompleteListOfUserCourse\GetCompleteListOfUserCourseHandle;
use App\Commands\UserCourse\GetListCourseCurrentUser\GetListCourseCurrentUserCommand;
use App\Commands\UserCourse\GetListCourseCurrentUser\GetListCourseCurrentUserHandle;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserCourse\CurrentUserCourseResource;
use App\Http\Resources\UserCourse\UserCourseResource;
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

        if(!empty($result['userCourses'])){
            return $this->responseSuccess(CurrentUserCourseResource::make($result['userCourses']),
                $result['message']);
        }

        return $this->responseError($result['message']);
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

        if(!empty($result['userCourses'])){
            return $this->responseSuccess(UserCourseResource::collection($result['userCourses']),
                $result['message']);
        }

        return $this->responseError($result['message']);
    }
}
