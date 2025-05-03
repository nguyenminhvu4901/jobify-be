<?php

namespace App\Http\Controllers\API\Profile;

use App\Commands\ProfileSeries\UserExperience\DestroyUserExperience\DestroyUserExperienceCommand;
use App\Commands\ProfileSeries\UserExperience\DestroyUserExperience\DestroyUserExperienceHandler;
use App\Commands\ProfileSeries\UserExperience\DetailListOfUserExperience\DetailListOfUserExperienceCommand;
use App\Commands\ProfileSeries\UserExperience\DetailListOfUserExperience\DetailListOfUserExperienceHandle;
use App\Commands\ProfileSeries\UserExperience\DetailListOfUserExperienceByUserSlug\DetailListOfUserExperienceByUserSlugCommand;
use App\Commands\ProfileSeries\UserExperience\DetailListOfUserExperienceByUserSlug\DetailListOfUserExperienceByUserSlugHandle;
use App\Commands\ProfileSeries\UserExperience\GetCompleteListOfUserExperience\GetCompleteListOfUserExperienceCommand;
use App\Commands\ProfileSeries\UserExperience\GetCompleteListOfUserExperience\GetCompleteListOfUserExperienceHandler;
use App\Commands\ProfileSeries\UserExperience\GetListExperienceCurrentUser\GetListExperienceCurrentUserCommand;
use App\Commands\ProfileSeries\UserExperience\GetListExperienceCurrentUser\GetListExperienceCurrentUserHandler;
use App\Commands\ProfileSeries\UserExperience\StoreUserExperience\StoreUserExperienceCommand;
use App\Commands\ProfileSeries\UserExperience\StoreUserExperience\StoreUserExperienceHandler;
use App\Commands\ProfileSeries\UserExperience\UpdateUserExperience\UpdateUserExperienceCommand;
use App\Commands\ProfileSeries\UserExperience\UpdateUserExperience\UpdateUserExperienceHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UserExperience\UserExperienceRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Joselfonseca\LaravelTactician\CommandBusInterface;
use OpenApi\Annotations as OA;

class UserExperienceController extends Controller
{
    public function __construct(
        protected CommandBusInterface $bus
    ) {
    }

    public function store(UserExperienceRequest $request): JsonResponse
    {
        $this->bus->addHandler(StoreUserExperienceCommand::class, StoreUserExperienceHandler::class);

        $result = $this->bus->dispatch(StoreUserExperienceCommand::withForm($request));

        if (! empty($result['data'])) {
            return $this->responseSuccess(data: $result['data'], message: $result['message']);
        }

        return $this->responseError(
            message: $result['message'],
            error: $result['error'] ?? null,
            statusCode: $result['status_code'] ?? null
        );
    }

    public function getListExperienceCurrentUser(): JsonResponse
    {
        $this->bus->addHandler(
            GetListExperienceCurrentUserCommand::class,
            GetListExperienceCurrentUserHandler::class
        );

        $result = $this->bus->dispatch(new GetListExperienceCurrentUserCommand());

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

    /**
     * @OA\Get(
     *     path="/profile/user-experience/complete-list-user-experience",
     *     summary="Get complete list of user experience",
     *     tags={"UserExperienceEnum"},
     *     security={{"bearerAuth": {}}},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *
     *         @OA\JsonContent(
     *             type="object",
     *
     *             @OA\Property(property="message", type="string", example="Hello World")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */
    public function getCompleteListOfUserExperience(FormRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            GetCompleteListOfUserExperienceCommand::class,
            GetCompleteListOfUserExperienceHandler::class
        );

        $result = $this->bus->dispatch(GetCompleteListOfUserExperienceCommand::withForm($request));

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

    public function getDetailListOfUserExperience(UserExperienceRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            DetailListOfUserExperienceCommand::class,
            DetailListOfUserExperienceHandle::class
        );

        $result = $this->bus->dispatch(DetailListOfUserExperienceCommand::withForm($request));

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

    public function getDetailListOfUserExperienceByUserSlug(UserExperienceRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            DetailListOfUserExperienceByUserSlugCommand::class,
            DetailListOfUserExperienceByUserSlugHandle::class
        );

        $result = $this->bus->dispatch(DetailListOfUserExperienceByUserSlugCommand::withForm($request));

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

    public function update(UserExperienceRequest $request): JsonResponse
    {
        $this->bus->addHandler(UpdateUserExperienceCommand::class, UpdateUserExperienceHandler::class);

        $result = $this->bus->dispatch(UpdateUserExperienceCommand::withForm($request));

        if (! empty($result['data'])) {
            return $this->responseSuccess(data: $result['data'], message: $result['message']);
        }

        return $this->responseError(
            message: $result['message'],
            error: $result['error'] ?? null,
            statusCode: $result['status_code'] ?? null
        );
    }

    public function destroy(UserExperienceRequest $request): JsonResponse
    {
        $this->bus->addHandler(DestroyUserExperienceCommand::class, DestroyUserExperienceHandler::class);

        $result = $this->bus->dispatch(DestroyUserExperienceCommand::withForm($request));

        if (! empty($result['userExperienceDestroy'])) {
            return $this->responseSuccessWithNoData(message: $result['message']);
        }

        return $this->responseError(
            message: $result['message'],
            error: $result['error'] ?? null,
            statusCode: $result['status_code'] ?? null
        );
    }
}
