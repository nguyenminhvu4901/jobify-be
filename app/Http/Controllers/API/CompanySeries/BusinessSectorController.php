<?php

namespace App\Http\Controllers\API\CompanySeries;

use App\Commands\CompanySeries\BusinessSector\GetListAllBusinessSector\GetListAllBusinessSectorCommand;
use App\Commands\CompanySeries\BusinessSector\GetListAllBusinessSector\GetListAllBusinessSectorHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Joselfonseca\LaravelTactician\CommandBusInterface;

class BusinessSectorController extends Controller
{
    public function __construct(
        protected CommandBusInterface $bus
    ) {
    }

    public function getListAllBusinessSector(): JsonResponse
    {
        $this->bus->addHandler(
            GetListAllBusinessSectorCommand::class,
            GetListAllBusinessSectorHandler::class
        );

        $result = $this->bus->dispatch(new GetListAllBusinessSectorCommand());

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
}
