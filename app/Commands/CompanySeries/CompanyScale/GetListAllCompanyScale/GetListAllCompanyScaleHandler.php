<?php

namespace App\Commands\CompanySeries\CompanyScale\GetListAllCompanyScale;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\CompanySeries\CompanyScaleEnum;
use App\Http\Resources\CompanySeries\CompanyScale\CompanyScaleResource;
use App\Repositories\CompanySeries\CompanyScale\CompanyScaleRepository;
use Illuminate\Support\Facades\Cache;

class GetListAllCompanyScaleHandler
{
    /**
     * @param CompanyScaleRepository $companyScaleRepository
     */
    public function __construct(
        protected CompanyScaleRepository $companyScaleRepository
    )
    {
    }

    /**
     * @return array
     */
    public function handle(): array
    {
        try {
            $cache = Cache::tags([CompanyScaleEnum::TAG_NAME->value])->has(
                CompanyScaleEnum::LIST_ALL_COMPANY_SCALE->value);

            $companyScales = Cache::tags([CompanyScaleEnum::TAG_NAME->value])
                ->remember(
                    CompanyScaleEnum::LIST_ALL_COMPANY_SCALE->value,
                    CacheTTL::HARD->value,
                    fn() => $this->companyScaleRepository->get()
                );

            return [
                'data' => CompanyScaleResource::collection($companyScales),
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
