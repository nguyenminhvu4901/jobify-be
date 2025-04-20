<?php

namespace App\Http\Controllers\API\JobSeries;

use App\Commands\JobSeries\JobListing\GetDetailJobByJobId\GetDetailJobByJobIdCommand;
use App\Commands\JobSeries\JobListing\GetDetailJobByJobId\GetDetailJobByJobIdHandler;
use App\Commands\JobSeries\JobListing\GetListAllJob\GetListAllJobCommand;
use App\Commands\JobSeries\JobListing\GetListAllJob\GetListAllJobHandler;
use App\Commands\JobSeries\JobListing\GetListAllJobByCompany\GetListAllJobByCompanyCommand;
use App\Commands\JobSeries\JobListing\GetListAllJobByCompany\GetListAllJobByCompanyHandler;
use App\Commands\JobSeries\JobListing\StoreJob\StoreJobCommand;
use App\Commands\JobSeries\JobListing\StoreJob\StoreJobHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\JobSeries\JobListing\JobSaveRequest;
use App\Http\Requests\JobSeries\JobListing\JobSearchRequest;
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

    /**
     * @param JobSearchRequest $request
     * @return JsonResponse
     */
    public function getListAllJobsByCompany(JobSearchRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            GetListAllJobByCompanyCommand::class,
            GetListAllJobByCompanyHandler::class
        );

        $result = $this->bus->dispatch(GetListAllJobByCompanyCommand::withForm($request));

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

    /**
     * @param JobSearchRequest $request
     * @return JsonResponse
     */
    public function getDetailJobByJobId(JobSearchRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            GetDetailJobByJobIdCommand::class,
            GetDetailJobByJobIdHandler::class
        );

        $result = $this->bus->dispatch(GetDetailJobByJobIdCommand::withForm($request));

        if(!empty($result['data'])){

            return $this->responseSuccess(
                data: $result['data'],
                message: $result['message'],
                cache: $result['cache'] ?? null,
            );
        }

        return $this->responseError(
            message: $result['message'],
            error: $result['error'] ?? null,
            statusCode: $result['status_code'] ?? null
        );
    }

    public function storeJob(JobSaveRequest $request): JsonResponse
    {

        $this->bus->addHandler(
            StoreJobCommand::class,
            StoreJobHandler::class
        );

        $result = $this->bus->dispatch(StoreJobCommand::withForm($request));

        if(!empty($result['data'])){

            return $this->responseSuccess(
                data: $result['data'],
                message: $result['message'],
            );
        }

        return $this->responseError(
            message: $result['message'],
            error: $result['error'] ?? null,
            statusCode: $result['status_code'] ?? null
        );
    }
}
