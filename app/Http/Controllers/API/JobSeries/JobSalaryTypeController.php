<?php

namespace App\Http\Controllers\API\JobSeries;

use App\Commands\JobSeries\JobSalaryType\GetListJobSalaryType\GetListJobSalaryTypeCommand;
use App\Commands\JobSeries\JobSalaryType\GetListJobSalaryType\GetListJobSalaryTypeHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Joselfonseca\LaravelTactician\CommandBusInterface;

class JobSalaryTypeController extends Controller
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
    public function getListJobSalaryType(): JsonResponse
    {
        $this->bus->addHandler(
            GetListJobSalaryTypeCommand::class,
            GetListJobSalaryTypeHandler::class
        );

        $result = $this->bus->dispatch(new GetListJobSalaryTypeCommand());

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
