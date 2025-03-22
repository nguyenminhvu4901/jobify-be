<?php

namespace App\Commands\BusinessSector\GetListAllBusinessSector;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\Company\BusinessSector;
use App\Http\Resources\Company\BusinessSector\BusinessSectorResource;
use App\Repositories\BusinessSector\BusinessSectorRepository;
use Illuminate\Support\Facades\Cache;

class GetListAllBusinessSectorHandler
{
    public function __construct(
        protected BusinessSectorRepository $businessSectorRepository
    )
    {
    }

    /**
     * @return array
     */
    public function handle(): array
    {
        try {
            $cache = Cache::tags([BusinessSector::TAG_NAME->value])->has(
                BusinessSector::LIST_ALL_BUSINESS_SECTOR->value);

            $businessSectors = Cache::tags([BusinessSector::TAG_NAME->value])
                ->remember(
                    BusinessSector::LIST_ALL_BUSINESS_SECTOR->value,
                    CacheTTL::HARD->value,
                    fn() => $this->businessSectorRepository->get()
                );

            return [
                'data' => BusinessSectorResource::collection($businessSectors),
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
