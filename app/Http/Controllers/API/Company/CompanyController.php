<?php

namespace App\Http\Controllers\API\Company;

use App\Commands\CompanySeries\CompanyProfile\GetDetailProfileCompanyCurrentUser\GetDetailProfileCompanyCurrentUserCommand;
use App\Commands\CompanySeries\CompanyProfile\GetDetailProfileCompanyCurrentUser\GetDetailProfileCompanyCurrentUserHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompanySeries\Company\CompanyRequest;
use Illuminate\Http\JsonResponse;
use Joselfonseca\LaravelTactician\CommandBusInterface;

class CompanyController extends Controller
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
    public function getDetailProfileCompanyCurrentUser(): JsonResponse
    {
        $this->bus->addHandler(
            GetDetailProfileCompanyCurrentUserCommand::class,
            GetDetailProfileCompanyCurrentUserHandler::class
        );

        $result = $this->bus->dispatch(new GetDetailProfileCompanyCurrentUserCommand());

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

    public function updateCompanyProfile(CompanyRequest $request)
    {

    }
}
