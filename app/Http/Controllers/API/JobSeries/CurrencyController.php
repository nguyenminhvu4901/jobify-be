<?php

namespace App\Http\Controllers\API\JobSeries;

use App\Commands\JobSeries\Currency\GetListCurrency\GetListCurrencyCommand;
use App\Commands\JobSeries\Currency\GetListCurrency\GetListCurrencyHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Joselfonseca\LaravelTactician\CommandBusInterface;

class CurrencyController extends Controller
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
    public function getListCurrency(): JsonResponse
    {
        $this->bus->addHandler(
            GetListCurrencyCommand::class,
            GetListCurrencyHandler::class
        );

        $result = $this->bus->dispatch(new GetListCurrencyCommand());

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
