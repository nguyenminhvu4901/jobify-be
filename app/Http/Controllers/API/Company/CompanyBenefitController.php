<?php

namespace App\Http\Controllers\API\Company;

use App\Commands\CompanySeries\CompanyBenefit\GetListCompanyBenefit\GetListCompanyBenefitCommand;
use App\Commands\CompanySeries\CompanyBenefit\GetListCompanyBenefit\GetListCompanyBenefitHandler;
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
}
