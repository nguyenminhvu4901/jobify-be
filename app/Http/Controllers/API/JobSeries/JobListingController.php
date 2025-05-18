<?php

namespace App\Http\Controllers\API\JobSeries;

use App\Commands\JobSeries\JobListing\DestroyJob\DestroyJobCommand;
use App\Commands\JobSeries\JobListing\DestroyJob\DestroyJobHandler;
use App\Commands\JobSeries\JobListing\GetDetailJobByJobId\GetDetailJobByJobIdCommand;
use App\Commands\JobSeries\JobListing\GetDetailJobByJobId\GetDetailJobByJobIdHandler;
use App\Commands\JobSeries\JobListing\GetListAllJob\GetListAllJobCommand;
use App\Commands\JobSeries\JobListing\GetListAllJob\GetListAllJobHandler;
use App\Commands\JobSeries\JobListing\GetListAllJobByCompany\GetListAllJobByCompanyCommand;
use App\Commands\JobSeries\JobListing\GetListAllJobByCompany\GetListAllJobByCompanyHandler;
use App\Commands\JobSeries\JobListing\SearchJob\SearchJobCommand;
use App\Commands\JobSeries\JobListing\SearchJob\SearchJobHandler;
use App\Commands\JobSeries\JobListing\StoreJob\StoreJobCommand;
use App\Commands\JobSeries\JobListing\StoreJob\StoreJobHandler;
use App\Commands\JobSeries\JobListing\UpdateJob\UpdateJobCommand;
use App\Commands\JobSeries\JobListing\UpdateJob\UpdateJobHandler;
use App\Commands\JobSeries\JobListing\UpdateJobActiveStatus\UpdateJobActiveStatusCommand;
use App\Commands\JobSeries\JobListing\UpdateJobActiveStatus\UpdateJobActiveStatusHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\JobSeries\JobListing\JobSaveRequest;
use App\Http\Requests\JobSeries\JobListing\JobGetRequest;
use App\Http\Requests\JobSeries\JobListing\JobSearchRequest;
use App\Http\Requests\JobSeries\JobListing\JobStatusRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Joselfonseca\LaravelTactician\CommandBusInterface;
use Laravel\Scout\Searchable;

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

    public function searchJob(JobSearchRequest $request): JsonResponse
    {
        $this->bus->addHandler(SearchJobCommand::class, SearchJobHandler::class);

        $result = $this->bus->dispatch(SearchJobCommand::withForm($request));

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
     * @param JobGetRequest $request
     * @return JsonResponse
     */
    public function getListAllJobsByCompany(JobGetRequest $request): JsonResponse
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
     * @param JobGetRequest $request
     * @return JsonResponse
     */
    public function getDetailJobByJobId(JobGetRequest $request): JsonResponse
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

    /**
     * @param JobSaveRequest $request
     * @return JsonResponse
     */
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

    /**
     * @param JobSaveRequest $request
     * @return JsonResponse
     */
    public function updateJob(JobSaveRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            UpdateJobCommand::class,
            UpdateJobHandler::class
        );

        $result = $this->bus->dispatch(UpdateJobCommand::withForm($request));

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

    public function updateJobActiveStatus(JobStatusRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            UpdateJobActiveStatusCommand::class,
            UpdateJobActiveStatusHandler::class
        );

        $result = $this->bus->dispatch(UpdateJobActiveStatusCommand::withForm($request));

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

    public function destroyJob(JobStatusRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            DestroyJobCommand::class, DestroyJobHandler::class
        );

        $result = $this->bus->dispatch(DestroyJobCommand::withForm($request));

        if(!empty($result['jobListingDestroy'])){
            return $this->responseSuccessWithNoData(message: $result['message']);
        }

        return $this->responseError(
            message: $result['message'],
            error: $result['error'] ?? null,
            statusCode: $result['status_code'] ?? null
        );
    }
}
