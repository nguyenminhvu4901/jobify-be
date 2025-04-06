<?php

namespace App\Commands\CompanySeries\CompanyBranch\GetListCompanyBranch;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\Company\CompanyBranch;
use App\Http\Resources\CompanyBranch\CompanyBranchResource;
use App\Repositories\CompanySeries\CompanyBranch\CompanyBranchRepository;
use Illuminate\Support\Facades\Cache;

class GetListCompanyBranchHandler
{
    /**
     * @param CompanyBranchRepository $companyBranchRepository
     */
    public function __construct(
        protected CompanyBranchRepository $companyBranchRepository
    )
    {
    }

    /**
     * @param GetListCompanyBranchCommand $command
     * @return array
     */
    public function handle(GetListCompanyBranchCommand $command): array
    {
        try {
            $cache = Cache::tags([CompanyBranch::TAG_NAME->value])->has(
                CompanyBranch::LIST_COMPANY_BRANCH->value .
                auth()->user()->id .
                $command->companyId
            );

            $companiesBranch = Cache::tags([CompanyBranch::TAG_NAME->value])->remember(
                CompanyBranch::LIST_COMPANY_BRANCH->value .
                auth()->user()->id .
                $command->companyId,
                CacheTTL::REMEMBER->value,
                fn() => $this->companyBranchRepository->getByValueColumn(
                    columnName: 'company_id',
                    columnValue: $command->companyId,
                    relationship: 'company'
                )
            );

            return [
                'data' => CompanyBranchResource::collection($companiesBranch),
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
