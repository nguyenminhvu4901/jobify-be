<?php

namespace App\Commands\CompanySeries\BusinessSector\GetListAllBusinessSector;

use App\Enums\RouteNames\CompanySeries\BusinessSectorEnum;
use App\Enums\TTL\CacheTTL;
use App\Http\Resources\CompanySeries\BusinessSector\BusinessSectorResource;
use App\Repositories\CompanySeries\BusinessSector\BusinessSectorRepository;
use Illuminate\Support\Facades\Cache;

class GetListAllBusinessSectorHandler
{
    public function __construct(
        protected BusinessSectorRepository $businessSectorRepository
    ) {
    }

    public function handle(): array
    {
        try {
            $cache = Cache::tags([BusinessSectorEnum::TAG_NAME->value])->has(
                BusinessSectorEnum::LIST_ALL_BUSINESS_SECTOR->value
            );

            $businessSectors = Cache::tags([BusinessSectorEnum::TAG_NAME->value])
                ->remember(
                    BusinessSectorEnum::LIST_ALL_BUSINESS_SECTOR->value,
                    CacheTTL::HARD->value,
                    fn () => $this->businessSectorRepository->get()
                );

            return [
                'data' => BusinessSectorResource::collection($businessSectors),
                'message' => __('messages.company.company_get_info_success'),
                'cache' => $cache,
            ];
        } catch (\Exception $e) {

            return [
                'message' => __('messages.company.company_get_info_error'),
                'error' => $e,
            ];
        }
    }
}
