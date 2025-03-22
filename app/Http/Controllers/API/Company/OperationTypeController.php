<?php

namespace App\Http\Controllers\API\Company;

use App\Commands\OperationType\GetListAllOperationType\GetListAllOperationTypeCommand;
use App\Commands\OperationType\GetListAllOperationType\GetListAllOperationTypeHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Joselfonseca\LaravelTactician\CommandBusInterface;

class OperationTypeController extends Controller
{
    public function __construct(
        protected CommandBusInterface $bus
    )
    {
    }

    /**
     * @return JsonResponse
     */
    public function getListAllOperationType(): JsonResponse
    {
        $this->bus->addHandler(
            GetListAllOperationTypeCommand::class,
            GetListAllOperationTypeHandler::class
        );

        $result = $this->bus->dispatch(new GetListAllOperationTypeCommand());

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
