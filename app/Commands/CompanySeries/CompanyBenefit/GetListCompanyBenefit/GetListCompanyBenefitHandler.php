<?php

namespace App\Commands\CompanySeries\CompanyBenefit\GetListCompanyBenefit;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\Company\CompanyBenefit;
use App\Http\Resources\CompanySeries\CompanyBenefit\CompanyBenefitResource;
use App\Repositories\CompanySeries\CompanyBenefit\CompanyBenefitRepository;
use Illuminate\Support\Facades\Cache;

class GetListCompanyBenefitHandler
{
    /**
     * @param CompanyBenefitRepository $companyBenefitRepository
     */
    public function __construct(
        protected CompanyBenefitRepository $companyBenefitRepository
    )
    {
    }

    /**
     * @param GetListCompanyBenefitCommand $command
     * @return array
     */
    public function handle(GetListCompanyBenefitCommand $command): array
    {
        try {
            $cache = Cache::tags([CompanyBenefit::TAG_NAME->value])->has(
                CompanyBenefit::LIST_COMPANY_BENEFIT->value.
                auth()->user()?->id .
                $command->companyId
            );

            $companyBenefits = Cache::tags([CompanyBenefit::TAG_NAME->value])->remember(
                CompanyBenefit::LIST_COMPANY_BENEFIT->value .
                auth()->user()->id .
                $command->companyId,
                CacheTTL::REMEMBER->value,
                fn() => $this->companyBenefitRepository->getByValueColumn(
                    columnName: 'company_id',
                    columnValue: $command->companyId,
                    relationship: 'companies'
                )
            );

            return [
                'data' => CompanyBenefitResource::collection($companyBenefits),
                'message' => __('messages.company.company_get_info_success'),
                'cache' => $cache,
            ];
        }catch (\Exception $e){

            return [
                'message' => __('messages.company.company_get_info_error'),
                'error' => $e
            ];
        }
    }
}
