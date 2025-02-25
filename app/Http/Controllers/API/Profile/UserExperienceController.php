<?php

namespace App\Http\Controllers\API\Profile;

use App\Commands\UserExperience\DestroyUserExperience\DestroyUserExperienceCommand;
use App\Commands\UserExperience\DestroyUserExperience\DestroyUserExperienceHandler;
use App\Commands\UserExperience\DetailListOfUserExperience\DetailListOfUserExperienceCommand;
use App\Commands\UserExperience\DetailListOfUserExperience\DetailListOfUserExperienceHandle;
use App\Commands\UserExperience\DetailListOfUserExperienceByUserSlug\DetailListOfUserExperienceByUserSlugCommand;
use App\Commands\UserExperience\DetailListOfUserExperienceByUserSlug\DetailListOfUserExperienceByUserSlugHandle;
use App\Commands\UserExperience\GetCompleteListOfUserExperience\GetCompleteListOfUserExperienceCommand;
use App\Commands\UserExperience\GetCompleteListOfUserExperience\GetCompleteListOfUserExperienceHandler;
use App\Commands\UserExperience\GetListExperienceCurrentUser\GetListExperienceCurrentUserCommand;
use App\Commands\UserExperience\GetListExperienceCurrentUser\GetListExperienceCurrentUserHandler;
use App\Commands\UserExperience\StoreUserExperience\StoreUserExperienceCommand;
use App\Commands\UserExperience\StoreUserExperience\StoreUserExperienceHandler;
use App\Commands\UserExperience\UpdateUserExperience\UpdateUserExperienceCommand;
use App\Commands\UserExperience\UpdateUserExperience\UpdateUserExperienceHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserExperience\UserExperienceRequest;
use Illuminate\Http\JsonResponse;
use Joselfonseca\LaravelTactician\CommandBusInterface;
use OpenApi\Annotations as OA;

class UserExperienceController extends Controller
{
    public function __construct(
        protected CommandBusInterface $bus
    )
    {
    }

    /**
     * @param UserExperienceRequest $request
     * @return JsonResponse

     */
    public function store(UserExperienceRequest $request): JsonResponse
    {
        $this->bus->addHandler(StoreUserExperienceCommand::class, StoreUserExperienceHandler::class);

        $result = $this->bus->dispatch(StoreUserExperienceCommand::withForm($request));

        if(!empty($result['userExperience'])){
            return $this->responseSuccess(data: $result['userExperience'], message: $result['message']);
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
    public function getListExperienceCurrentUser(): JsonResponse
    {
        $this->bus->addHandler(GetListExperienceCurrentUserCommand::class,
            GetListExperienceCurrentUserHandler::class);

        $result = $this->bus->dispatch(new GetListExperienceCurrentUserCommand());

        if(!empty($result['userExperience'])){
            return $this->responseSuccess(data: $result['userExperience'], message: $result['message']);
        }

        return $this->responseError(
            message: $result['message'],
            error: $result['error'] ?? null,
            statusCode: $result['status_code'] ?? null
        );
    }

    /**
     * @OA\Get(
     *     path="/profile/user-experience/complete-list-user-experience",
     *     summary="Get complete list of user experience",
     *     tags={"UserExperience"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Hello World")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     * @return JsonResponse
     */
    public function getCompleteListOfUserExperience(): JsonResponse
    {
        $this->bus->addHandler(GetCompleteListOfUserExperienceCommand::class,
            GetCompleteListOfUserExperienceHandler::class);

        $result = $this->bus->dispatch(new GetCompleteListOfUserExperienceCommand());

        if(!empty($result['userExperiences'])){
            return $this->responseSuccess(data: $result['userExperiences'], message: $result['message']);
        }

        return $this->responseError(
            message: $result['message'],
            error: $result['error'] ?? null,
            statusCode: $result['status_code'] ?? null
        );
    }

    /**
     * @param UserExperienceRequest $request
     * @return JsonResponse
     */
    public function getDetailListOfUserExperience(UserExperienceRequest $request): JsonResponse
    {
        $this->bus->addHandler(DetailListOfUserExperienceCommand::class,
            DetailListOfUserExperienceHandle::class);

        $result = $this->bus->dispatch(DetailListOfUserExperienceCommand::withForm($request));

        if(!empty($result['userExperience'])){
            return $this->responseSuccess(data: $result['userExperience'], message: $result['message']);
        }

        return $this->responseError(
            message: $result['message'],
            error: $result['error'] ?? null,
            statusCode: $result['status_code'] ?? null
        );
    }

    /**
     * @param UserExperienceRequest $request
     * @return JsonResponse
     */
    public function getDetailListOfUserExperienceByUserSlug(UserExperienceRequest $request): JsonResponse
    {
        $this->bus->addHandler(DetailListOfUserExperienceByUserSlugCommand::class,
            DetailListOfUserExperienceByUserSlugHandle::class);

        $result = $this->bus->dispatch(DetailListOfUserExperienceByUserSlugCommand::withForm($request));

        if(!empty($result['userExperiences'])){
            return $this->responseSuccess(data: $result['userExperiences'], message: $result['message']);
        }

        return $this->responseError(
            message: $result['message'],
            error: $result['error'] ?? null,
            statusCode: $result['status_code'] ?? null
        );
    }

    /**
     * @param UserExperienceRequest $request
     * @return JsonResponse
     */
    public function update(UserExperienceRequest $request): JsonResponse
    {
        $this->bus->addHandler(UpdateUserExperienceCommand::class, UpdateUserExperienceHandler::class);

        $result = $this->bus->dispatch(UpdateUserExperienceCommand::withForm($request));

        if(!empty($result['userExperience'])){
            return $this->responseSuccess(data: $result['userExperience'], message: $result['message']);
        }

        return $this->responseError(
            message: $result['message'],
            error: $result['error'] ?? null,
            statusCode: $result['status_code'] ?? null
        );
    }

    /**
     * @param UserExperienceRequest $request
     * @return JsonResponse
     */
    public function destroy(UserExperienceRequest $request): JsonResponse
    {
        $this->bus->addHandler(DestroyUserExperienceCommand::class, DestroyUserExperienceHandler::class);

        $result = $this->bus->dispatch(DestroyUserExperienceCommand::withForm($request));

        if($result['userExperienceDestroy']){
            return $this->responseSuccessWithNoData(message: $result['message']);
        }

        return $this->responseError(
            message: $result['message'],
            error: $result['error'] ?? null,
            statusCode: $result['status_code'] ?? null
        );
    }
}
