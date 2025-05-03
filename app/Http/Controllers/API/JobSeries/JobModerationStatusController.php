<?php

namespace App\Http\Controllers\API\JobSeries;

use App\Commands\JobSeries\JobModerationStatus\GetListJobModerationStatus\GetListJobModerationStatusCommand;
use App\Commands\JobSeries\JobModerationStatus\GetListJobModerationStatus\GetListJobModerationStatusHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Joselfonseca\LaravelTactician\CommandBusInterface;

class JobModerationStatusController extends Controller
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
    public function getListJobModerationStatus(): JsonResponse
    {
        $this->bus->addHandler(
            GetListJobModerationStatusCommand::class,
            GetListJobModerationStatusHandler::class
        );

        $result = $this->bus->dispatch(new GetListJobModerationStatusCommand());

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
            statusCode: $result['status_code'] ?? null,
        );
    }
}
