<?php

namespace App\Http\Controllers\API\Company;

use App\Commands\CompanySeries\CompanyScale\GetListAllCompanyScale\GetListAllCompanyScaleCommand;
use App\Commands\CompanySeries\CompanyScale\GetListAllCompanyScale\GetListAllCompanyScaleHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Joselfonseca\LaravelTactician\CommandBusInterface;

class CompanyScaleController extends Controller
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
    public function getListAllCompanyScale(): JsonResponse
    {
        $this->bus->addHandler(
            GetListAllCompanyScaleCommand::class,
            GetListAllCompanyScaleHandler::class
        );

        $result = $this->bus->dispatch(new GetListAllCompanyScaleCommand());

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
