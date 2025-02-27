<?php

namespace App\Http\Controllers\API\Profile;

use App\Commands\UserProduct\DestroyUserProduct\DestroyUserProductCommand;
use App\Commands\UserProduct\DestroyUserProduct\DestroyUserProductHandle;
use App\Commands\UserProduct\GetCompleteListOfUserProduct\GetCompleteListOfUserProductCommand;
use App\Commands\UserProduct\GetCompleteListOfUserProduct\GetCompleteListOfUserProductHandle;
use App\Commands\UserProduct\GetDetailListOfUserProduct\GetDetailListOfUserProductCommand;
use App\Commands\UserProduct\GetDetailListOfUserProduct\GetDetailListOfUserProductHandle;
use App\Commands\UserProduct\GetDetailListOfUserProductByUserSlug\GetDetailListOfUserProductByUserSlugCommand;
use App\Commands\UserProduct\GetDetailListOfUserProductByUserSlug\GetDetailListOfUserProductByUserSlugHandle;
use App\Commands\UserProduct\GetListProductCurrentUser\GetListProductCurrentUserCommand;
use App\Commands\UserProduct\GetListProductCurrentUser\GetListProductCurrentUserHandle;
use App\Commands\UserProduct\StoreUserProduct\StoreUserProductCommand;
use App\Commands\UserProduct\StoreUserProduct\StoreUserProductHandle;
use App\Commands\UserProduct\UpdateUserProduct\UpdateUserProductCommand;
use App\Commands\UserProduct\UpdateUserProduct\UpdateUserProductHandle;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserProduct\UserProductRequest;
use Illuminate\Http\JsonResponse;
use Joselfonseca\LaravelTactician\CommandBusInterface;

class UserProductController extends Controller
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
    public function getListProductCurrentUser(): JsonResponse
    {
        $this->bus->addHandler(
            GetListProductCurrentUserCommand::class,
            GetListProductCurrentUserHandle::class
        );

        $result = $this->bus->dispatch(new GetListProductCurrentUserCommand());

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
    public function getCompleteListOfUserProduct(): JsonResponse
    {
        $this->bus->addHandler(
            GetCompleteListOfUserProductCommand::class,
            GetCompleteListOfUserProductHandle::class
        );

        $result = $this->bus->dispatch(new GetCompleteListOfUserProductCommand());

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
     * @param UserProductRequest $request
     * @return JsonResponse
     */
    public function getDetailListOfUserProduct(UserProductRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            GetDetailListOfUserProductCommand::class,
            GetDetailListOfUserProductHandle::class
        );

        $result = $this->bus->dispatch(GetDetailListOfUserProductCommand::withForm($request));

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
     * @param UserProductRequest $request
     * @return JsonResponse
     */
    public function getDetailListOfUserProductByUserSlug(UserProductRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            GetDetailListOfUserProductByUserSlugCommand::class,
            GetDetailListOfUserProductByUserSlugHandle::class
        );

        $result = $this->bus->dispatch(GetDetailListOfUserProductByUserSlugCommand::withForm($request));

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
     * @param UserProductRequest $request
     * @return JsonResponse
     */
    public function store(UserProductRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            StoreUserProductCommand::class,
            StoreUserProductHandle::class
        );

        $result = $this->bus->dispatch(StoreUserProductCommand::withForm($request));

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
     * @param UserProductRequest $request
     * @return JsonResponse
     */
    public function update(UserProductRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            UpdateUserProductCommand::class,
            UpdateUserProductHandle::class
        );

        $result = $this->bus->dispatch(UpdateUserProductCommand::withForm($request));

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
     * @param UserProductRequest $request
     * @return JsonResponse
     */
    public function destroy(UserProductRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            DestroyUserProductCommand::class,
            DestroyUserProductHandle::class
        );

        $result = $this->bus->dispatch(DestroyUserProductCommand::withForm($request));

        if($result['userProductDestroy']){
            return $this->responseSuccessWithNoData(message: $result['message']);
        }

        return $this->responseError(
            message: $result['message'],
            error: $result['error'] ?? null,
            statusCode: $result['status_code'] ?? null
        );
    }
}
