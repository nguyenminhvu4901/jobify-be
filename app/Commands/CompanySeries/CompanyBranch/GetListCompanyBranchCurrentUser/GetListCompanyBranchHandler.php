<?php

namespace App\Commands\CompanySeries\CompanyBranch\GetListCompanyBranchCurrentUser;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\Company\CompanyBranch;
use App\Http\Resources\CompanyBranch\CompanyBranchResource;
use App\Repositories\CompanySeries\Company\CompanyRepository;
use Illuminate\Support\Facades\Cache;

class GetListCompanyBranchHandler
{
    /**
     * @param CompanyRepository $companyRepository
     */
    public function __construct(
        protected CompanyRepository $companyRepository
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
                fn() => $this->companyRepository->findWithRelationships(
                    $command->companyId,
                    [
                        'companyBranches' => function ($q) {
                            return $q->orderByDesc('id');
                        }
                    ]
                )
            );

            if(!empty($companiesBranch)){
                return [
                    'data' => CompanyBranchResource::collection($companiesBranch?->companyBranches),
                    'message' => __('messages.company.company_get_info_success'),
                    'cache' => $cache,
                ];
            }

            return [
                'message' => __('messages.company.company_get_info_error'),
            ];
        }catch (\Exception $e){

            return [
                'message' => __('messages.company.company_get_info_error'),
                'error' => $e
            ];
        }
    }
}
