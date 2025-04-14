<?php

namespace App\Http\Controllers\API\JobSeries;

use App\Commands\JobSeries\Position\GetListLeafPosition\GetListLeafPositionCommand;
use App\Commands\JobSeries\Position\GetListLeafPosition\GetListLeafPositionHandler;
use App\Commands\JobSeries\Position\GetListPosition\GetListPositionCommand;
use App\Commands\JobSeries\Position\GetListPosition\GetListPositionHandler;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Joselfonseca\LaravelTactician\CommandBusInterface;

class PositionController extends Controller
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
     * @param FormRequest $request
     * @return JsonResponse
     */
    public function getListPosition(FormRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            GetListPositionCommand::class,
            GetListPositionHandler::class
        );

        $result = $this->bus->dispatch(GetListPositionCommand::withForm($request));

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

    /**
     * @return JsonResponse
     */
    public function getListLeafPosition(): JsonResponse
    {
        $this->bus->addHandler(
            GetListLeafPositionCommand::class,
            GetListLeafPositionHandler::class
        );

        $result = $this->bus->dispatch(new GetListLeafPositionCommand());

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
}
