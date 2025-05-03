<?php

namespace App\Http\Controllers\API\JobSeries;

use App\Commands\JobSeries\JobExperience\GetListJobExperience\GetListJobExperienceCommand;
use App\Commands\JobSeries\JobExperience\GetListJobExperience\GetListJobExperienceHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Joselfonseca\LaravelTactician\CommandBusInterface;

class JobExperienceController extends Controller
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
    public function getListJobExperience(): JsonResponse
    {
        $this->bus->addHandler(
            GetListJobExperienceCommand::class,
            GetListJobExperienceHandler::class
        );

        $result = $this->bus->dispatch(new GetListJobExperienceCommand());

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
