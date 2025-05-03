<?php

namespace App\Http\Controllers\API\JobSeries;

use App\Commands\JobSeries\JobLevel\GetListJobLevel\GetListJobLevelCommand;
use App\Commands\JobSeries\JobLevel\GetListJobLevel\GetListJobLevelHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Joselfonseca\LaravelTactician\CommandBusInterface;

class JobLevelController extends Controller
{
    public function __construct(
        protected CommandBusInterface $bus
    ) {
    }

    public function getListJobLevel(): JsonResponse
    {
        $this->bus->addHandler(
            GetListJobLevelCommand::class,
            GetListJobLevelHandler::class
        );

        $result = $this->bus->dispatch(new GetListJobLevelCommand());

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
