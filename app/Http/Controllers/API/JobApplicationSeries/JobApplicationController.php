<?php

namespace App\Http\Controllers\API\JobApplicationSeries;

use App\Commands\JobApplicationSeries\JobApplication\GetDetailJobApplicationJobSeeker\GetDetailJobApplicationJobSeekerCommand;
use App\Commands\JobApplicationSeries\JobApplication\GetDetailJobApplicationJobSeeker\GetDetailJobApplicationJobSeekerHandler;
use App\Commands\JobApplicationSeries\JobApplication\GetListJobApplicationByJobSeeker\GetListJobApplicationByJobSeekerCommand;
use App\Commands\JobApplicationSeries\JobApplication\GetListJobApplicationByJobSeeker\GetListJobApplicationByJobSeekerHandler;
use App\Commands\JobApplicationSeries\JobApplication\GetListJobSeekerApplyJob\GetListJobSeekerApplyJobCommand;
use App\Commands\JobApplicationSeries\JobApplication\GetListJobSeekerApplyJob\GetListJobSeekerApplyJobHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\JobApplicationSeries\JobApplication\JobApplicationRequest;
use Illuminate\Http\JsonResponse;
use Joselfonseca\LaravelTactician\CommandBusInterface;

class JobApplicationController extends Controller
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
     * @param JobApplicationRequest $request
     * @return JsonResponse
     */
    public function getListJobApplicationByJobSeeker(JobApplicationRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            GetListJobApplicationByJobSeekerCommand::class,
            GetListJobApplicationByJobSeekerHandler::class
        );

        $result = $this->bus->dispatch(GetListJobApplicationByJobSeekerCommand::withForm($request));

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
            statusCode: $result['status_code'] ?? null,
        );
    }

    /**
     * @param JobApplicationRequest $request
     * @return JsonResponse
     */
    public function getDetailJobApplicationJobSeeker(JobApplicationRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            GetDetailJobApplicationJobSeekerCommand::class,
            GetDetailJobApplicationJobSeekerHandler::class
        );

        $result = $this->bus->dispatch(GetDetailJobApplicationJobSeekerCommand::withForm($request));

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

    /**
     * @param JobApplicationRequest $request
     * @return JsonResponse
     */
    public function getListJobSeekerApplyJob(JobApplicationRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            GetListJobSeekerApplyJobCommand::class,
            GetListJobSeekerApplyJobHandler::class
        );

        $result = $this->bus->dispatch(GetListJobSeekerApplyJobCommand::withForm($request));

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
