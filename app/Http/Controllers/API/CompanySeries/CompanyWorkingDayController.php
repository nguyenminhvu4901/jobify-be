<?php

namespace App\Http\Controllers\API\CompanySeries;

use App\Commands\CompanySeries\CompanyWorkingDay\GetListAllWorkingDay\GetListAllWorkingDayCommand;
use App\Commands\CompanySeries\CompanyWorkingDay\GetListAllWorkingDay\GetListAllWorkingDayHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Joselfonseca\LaravelTactician\CommandBusInterface;

class CompanyWorkingDayController extends Controller
{
    public function __construct(
        protected CommandBusInterface $bus
    )
    {
    }

    /**
     * @return JsonResponse
     */
    public function getListAllWorkingDay(): JsonResponse
    {
        $this->bus->addHandler(
            GetListAllWorkingDayCommand::class,
            GetListAllWorkingDayHandler::class
        );

        $result = $this->bus->dispatch(new GetListAllWorkingDayCommand());

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
