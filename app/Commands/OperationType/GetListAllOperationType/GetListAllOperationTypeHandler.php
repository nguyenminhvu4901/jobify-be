<?php

namespace App\Commands\OperationType\GetListAllOperationType;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\Company\OperationType;
use App\Http\Resources\Company\OperationType\OperationTypeResource;
use App\Repositories\OperationType\OperationTypeRepository;
use Illuminate\Support\Facades\Cache;

class GetListAllOperationTypeHandler
{
    public function __construct(
        protected OperationTypeRepository $operationTypeRepository
    )
    {
    }

    /**
     * @return array
     */
    public function handle(): array
    {
        try {
            $cache = Cache::tags([OperationType::TAG_NAME->value])->has(
                OperationType::LIST_ALL_OPERATION_TYPE->value);

            $operationTypes = Cache::tags([OperationType::TAG_NAME->value])
                ->remember(
                    OperationType::LIST_ALL_OPERATION_TYPE->value,
                    CacheTTL::HARD->value,
                    fn() => $this->operationTypeRepository->get()
                );

            return [
                'data' => OperationTypeResource::collection($operationTypes),
                'message' => __('messages.company.company_get_info_success'),
                'cache' => $cache
            ];
        }catch (\Exception $e){

            return [
                'message' => __('messages.company.company_get_info_error'),
                'error' => $e
            ];
        }
    }
}
