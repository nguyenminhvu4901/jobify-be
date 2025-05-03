<?php

namespace App\Http\Controllers\API\JobSeries;

use App\Commands\JobSeries\JobVisibilityStatus\GetListJobVisibilityStatus\GetListJobVisibilityStatusCommand;
use App\Commands\JobSeries\JobVisibilityStatus\GetListJobVisibilityStatus\GetListJobVisibilityStatusHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Joselfonseca\LaravelTactician\CommandBusInterface;

class JobVisibilityStatusController extends Controller
{
    public function __construct(
        protected CommandBusInterface $bus
    ) {
    }

    public function getListJobVisibilityStatus(): JsonResponse
    {
        $this->bus->addHandler(
            GetListJobVisibilityStatusCommand::class,
            GetListJobVisibilityStatusHandler::class
        );

        $result = $this->bus->dispatch(new GetListJobVisibilityStatusCommand());

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
            statusCode: $result['status_code'] ?? null,
        );
    }
}
