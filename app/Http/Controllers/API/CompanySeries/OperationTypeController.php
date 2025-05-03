<?php

namespace App\Http\Controllers\API\CompanySeries;

use App\Commands\CompanySeries\OperationType\GetListAllOperationType\GetListAllOperationTypeCommand;
use App\Commands\CompanySeries\OperationType\GetListAllOperationType\GetListAllOperationTypeHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Joselfonseca\LaravelTactician\CommandBusInterface;

class OperationTypeController extends Controller
{
    public function __construct(
        protected CommandBusInterface $bus
    ) {
    }

    public function getListAllOperationType(): JsonResponse
    {
        $this->bus->addHandler(
            GetListAllOperationTypeCommand::class,
            GetListAllOperationTypeHandler::class
        );

        $result = $this->bus->dispatch(new GetListAllOperationTypeCommand());

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
