<?php

namespace App\Http\Controllers\API\JobSeries;

use App\Commands\JobSeries\JobType\GetListJobType\GetListJobTypeCommand;
use App\Commands\JobSeries\JobType\GetListJobType\GetListJobTypeHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Joselfonseca\LaravelTactician\CommandBusInterface;

class JobTypeController extends Controller
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
    public function getListJobType(): JsonResponse
    {

        $this->bus->addHandler(
            GetListJobTypeCommand::class,
            GetListJobTypeHandler::class
        );

        $result = $this->bus->dispatch(new GetListJobTypeCommand());

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
