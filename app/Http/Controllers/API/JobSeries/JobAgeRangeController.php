<?php

namespace App\Http\Controllers\API\JobSeries;

use App\Commands\JobSeries\JobAgeRange\GetListJobAgeRange\GetListJobAgeRangeCommand;
use App\Commands\JobSeries\JobAgeRange\GetListJobAgeRange\GetListJobAgeRangeHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Joselfonseca\LaravelTactician\CommandBusInterface;

class JobAgeRangeController extends Controller
{
    public function __construct(
        protected CommandBusInterface $bus
    ) {
    }

    public function getListJobAgeRange(): JsonResponse
    {
        $this->bus->addHandler(
            GetListJobAgeRangeCommand::class,
            GetListJobAgeRangeHandler::class
        );

        $result = $this->bus->dispatch(new GetListJobAgeRangeCommand());

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
