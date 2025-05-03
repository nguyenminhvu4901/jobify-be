<?php

namespace App\Http\Controllers\API\JobApplicationSeries;

use App\Commands\JobApplicationSeries\ApplicationStatus\GetListApplicationStatus\GetListApplicationStatusCommand;
use App\Commands\JobApplicationSeries\ApplicationStatus\GetListApplicationStatus\GetListApplicationStatusHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Joselfonseca\LaravelTactician\CommandBusInterface;

class ApplicationStatusController extends Controller
{
    public function __construct(
        protected CommandBusInterface $bus
    ) {
    }

    public function getListApplicationStatuses(): JsonResponse
    {
        $this->bus->addHandler(
            GetListApplicationStatusCommand::class,
            GetListApplicationStatusHandler::class
        );

        $result = $this->bus->dispatch(new GetListApplicationStatusCommand());

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
