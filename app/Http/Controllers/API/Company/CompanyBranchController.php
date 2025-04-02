<?php

namespace App\Http\Controllers\API\Company;

use App\Commands\CompanySeries\CompanyBranch\DestroyCompanyBranch\DestroyCompanyBranchCommand;
use App\Commands\CompanySeries\CompanyBranch\DestroyCompanyBranch\DestroyCompanyBranchHandler;
use App\Commands\CompanySeries\CompanyBranch\StoreCompanyBranch\StoreCompanyBranchCommand;
use App\Commands\CompanySeries\CompanyBranch\StoreCompanyBranch\StoreCompanyBranchHandler;
use App\Commands\CompanySeries\CompanyBranch\UpdateBranchCompany\UpdateCompanyBranchCommand;
use App\Commands\CompanySeries\CompanyBranch\UpdateBranchCompany\UpdateCompanyBranchHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompanySeries\CompanyBranch\CompanyBranchRequest;
use Illuminate\Http\JsonResponse;
use Joselfonseca\LaravelTactician\CommandBusInterface;

class CompanyBranchController extends Controller
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
     * @param CompanyBranchRequest $request
     * @return JsonResponse
     */
    public function updateCompanyBranch(CompanyBranchRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            UpdateCompanyBranchCommand::class,
            UpdateCompanyBranchHandler::class
        );

        $result = $this->bus->dispatch(UpdateCompanyBranchCommand::withForm($request));

        if(!empty($result['data'])){
            return $this->responseSuccess(
                data: $result['data'],
                message: $result['message']
            );
        }

        return $this->responseError(
            message: $result['message'],
            error: $result['error'] ?? null,
            statusCode: $result['status_code'] ?? null,
        );
    }

    /**
     * @param CompanyBranchRequest $request
     * @return JsonResponse
     */
    public function storeCompanyBranch(CompanyBranchRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            StoreCompanyBranchCommand::class,
            StoreCompanyBranchHandler::class
        );

        $result = $this->bus->dispatch(StoreCompanyBranchCommand::withForm($request));

        if(!empty($result['data'])){
            return $this->responseSuccess(
                data: $result['data'],
                message: $result['message']
            );
        }

        return $this->responseError(
            message: $result['message'],
            error: $result['error'] ?? null,
            statusCode: $result['status_code'] ?? null,
        );
    }

    public function destroyCompanyBranch(CompanyBranchRequest $request)
    {
        $this->bus->addHandler(
            DestroyCompanyBranchCommand::class,
            DestroyCompanyBranchHandler::class
        );

        $result = $this->bus->dispatch(DestroyCompanyBranchCommand::withForm($request));

        if($result['companyBranchDestroy']){
            return $this->responseSuccessWithNoData(message: $result['message']);
        }

        return $this->responseError(
            message: $result['message'],
            error: $result['error'] ?? null,
            statusCode: $result['status_code'] ?? null
        );
    }
}
