<?php

namespace App\Http\Controllers\API\JobSeries;

use App\Commands\JobSeries\JobEducationLevel\GetListJobEducationLevel\GetListJobEducationLevelCommand;
use App\Commands\JobSeries\JobEducationLevel\GetListJobEducationLevel\GetListJobEducationLevelHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Joselfonseca\LaravelTactician\CommandBusInterface;

class JobEducationLevelController extends Controller
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
    public function getListJobEducationLevel(): JsonResponse
    {
        $this->bus->addHandler(
            GetListJobEducationLevelCommand::class,
            GetListJobEducationLevelHandler::class
        );

        $result = $this->bus->dispatch(new GetListJobEducationLevelCommand());

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
