<?php

namespace App\Http\Controllers\API\JobSeries;

use App\Commands\JobSeries\JobListing\GetListAllJob\GetListAllJobCommand;
use App\Commands\JobSeries\JobListing\GetListAllJob\GetListAllJobHandler;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Joselfonseca\LaravelTactician\CommandBusInterface;

class JobListingController extends Controller
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
    public function getListAllJobs(FormRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            GetListAllJobCommand::class,
            GetListAllJobHandler::class
        );

        $result = $this->bus->dispatch(GetListAllJobCommand::withForm($request));

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
}
