<?php

namespace App\Http\Controllers\API\Company;

use App\Commands\CompanySeries\CompanyBenefit\DestroyCompanyBenefit\DestroyCompanyBenefitCommand;
use App\Commands\CompanySeries\CompanyBenefit\DestroyCompanyBenefit\DestroyCompanyBenefitHandler;
use App\Commands\CompanySeries\CompanyBenefit\GetListCompanyBenefit\GetListCompanyBenefitCommand;
use App\Commands\CompanySeries\CompanyBenefit\GetListCompanyBenefit\GetListCompanyBenefitHandler;
use App\Commands\CompanySeries\CompanyBenefit\StoreCompanyBenefit\StoreCompanyBenefitCommand;
use App\Commands\CompanySeries\CompanyBenefit\StoreCompanyBenefit\StoreCompanyBenefitHandler;
use App\Commands\CompanySeries\CompanyBenefit\UpdateCompanyBenefit\UpdateCompanyBenefitCommand;
use App\Commands\CompanySeries\CompanyBenefit\UpdateCompanyBenefit\UpdateCompanyBenefitHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompanySeries\CompanyBenefit\CompanyBenefitRequest;
use Illuminate\Http\JsonResponse;
use Joselfonseca\LaravelTactician\CommandBusInterface;

class CompanyBenefitController extends Controller
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
     * @param CompanyBenefitRequest $request
     * @return JsonResponse
     */
    public function getListCompanyBenefit(CompanyBenefitRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            GetListCompanyBenefitCommand::class,
            GetListCompanyBenefitHandler::class
        );

        $result = $this->bus->dispatch(GetListCompanyBenefitCommand::withForm($request));

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
     * @param CompanyBenefitRequest $request
     * @return JsonResponse
     */
    public function storeCompanyBenefit(CompanyBenefitRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            StoreCompanyBenefitCommand::class,
            StoreCompanyBenefitHandler::class
        );

        $result = $this->bus->dispatch(StoreCompanyBenefitCommand::withForm($request));

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
     * @param CompanyBenefitRequest $request
     * @return JsonResponse
     */
    public function updateCompanyBenefit(CompanyBenefitRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            UpdateCompanyBenefitCommand::class,
            UpdateCompanyBenefitHandler::class
        );

        $result = $this->bus->dispatch(UpdateCompanyBenefitCommand::withForm($request));

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
     * @param CompanyBenefitRequest $request
     * @return JsonResponse
     */
    public function destroyCompanyBenefit(CompanyBenefitRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            DestroyCompanyBenefitCommand::class,
            DestroyCompanyBenefitHandler::class
        );

        $result = $this->bus->dispatch(DestroyCompanyBenefitCommand::withForm($request));

        if(!empty($result['companyBenefitDestroy'])){
            return $this->responseSuccessWithNoData(message: $result['message']);
        }

        return $this->responseError(
            message: $result['message'],
            error: $result['error'] ?? null,
            statusCode: $result['status_code'] ?? null
        );
    }
}
