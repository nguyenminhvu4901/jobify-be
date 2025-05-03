<?php

namespace App\Http\Controllers\API\CompanySeries;

use App\Commands\CompanySeries\CompanyProfile\GetDetailProfileCompanyCurrentUser\GetDetailProfileCompanyCurrentUserCommand;
use App\Commands\CompanySeries\CompanyProfile\GetDetailProfileCompanyCurrentUser\GetDetailProfileCompanyCurrentUserHandler;
use App\Commands\CompanySeries\CompanyProfile\UpdateCompanyAvatar\UpdateCompanyAvatarCommand;
use App\Commands\CompanySeries\CompanyProfile\UpdateCompanyAvatar\UpdateCompanyAvatarHandler;
use App\Commands\CompanySeries\CompanyProfile\UpdateCompanyProfile\UpdateCompanyProfileCommand;
use App\Commands\CompanySeries\CompanyProfile\UpdateCompanyProfile\UpdateCompanyProfileHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompanySeries\Company\CompanyAvatarRequest;
use App\Http\Requests\CompanySeries\Company\CompanyRequest;
use Illuminate\Http\JsonResponse;
use Joselfonseca\LaravelTactician\CommandBusInterface;

class CompanyController extends Controller
{
    public function __construct(
        protected CommandBusInterface $bus
    ) {
    }

    public function getDetailProfileCompanyCurrentUser(): JsonResponse
    {
        $this->bus->addHandler(
            GetDetailProfileCompanyCurrentUserCommand::class,
            GetDetailProfileCompanyCurrentUserHandler::class
        );

        $result = $this->bus->dispatch(new GetDetailProfileCompanyCurrentUserCommand());

        if (! empty($result['data'])) {
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

    public function updateCompanyProfile(CompanyRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            UpdateCompanyProfileCommand::class,
            UpdateCompanyProfileHandler::class
        );

        $result = $this->bus->dispatch(UpdateCompanyProfileCommand::withForm($request));

        if (! empty($result['data'])) {
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

    public function updateCompanyAvatar(CompanyAvatarRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            UpdateCompanyAvatarCommand::class,
            UpdateCompanyAvatarHandler::class
        );

        $result = $this->bus->dispatch(UpdateCompanyAvatarCommand::withForm($request));

        if (! empty($result['company'])) {
            return $this->responseSuccess(data: $result['company'], message: $result['message']);
        }

        return $this->responseError(
            message: $result['message'],
            error: $result['error'] ?? null,
            statusCode: $result['status_code'] ?? null
        );
    }
}
