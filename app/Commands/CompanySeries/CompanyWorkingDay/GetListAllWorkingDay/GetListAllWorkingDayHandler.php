<?php

namespace App\Commands\CompanySeries\CompanyWorkingDay\GetListAllWorkingDay;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\Company\CompanyWorkingDayEnum;
use App\Http\Resources\CompanySeries\CompanyWorkingDay\CompanyWorkingDayResource;
use App\Repositories\CompanySeries\CompanyWorkingDay\CompanyWorkingDayRepository;
use Illuminate\Support\Facades\Cache;

class GetListAllWorkingDayHandler
{
    public function __construct(
        protected CompanyWorkingDayRepository $companyWorkingDayRepository
    )
    {
    }

    /**
     * @return array
     */
    public function handle(): array
    {
        try {
            $cache = Cache::tags([CompanyWorkingDayEnum::TAG_NAME->value])->has(
                CompanyWorkingDayEnum::LIST_ALL_WORKING_DAY->value);

            $companyWorkingDay = Cache::tags([CompanyWorkingDayEnum::TAG_NAME->value])
                ->remember(
                    CompanyWorkingDayEnum::LIST_ALL_WORKING_DAY->value,
                    CacheTTL::HARD->value,
                    fn() => $this->companyWorkingDayRepository->get()
                );

            return [
                'data' => CompanyWorkingDayResource::collection($companyWorkingDay),
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
