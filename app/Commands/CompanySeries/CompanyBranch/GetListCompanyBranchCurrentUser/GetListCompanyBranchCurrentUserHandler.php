<?php

namespace App\Commands\CompanySeries\CompanyBranch\GetListCompanyBranchCurrentUser;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\Company\CompanyBranch;
use App\Http\Resources\CompanySeries\CompanyProfile\CompanyProfileResource;
use App\Repositories\CompanySeries\Company\CompanyRepository;
use Illuminate\Support\Facades\Cache;

class GetListCompanyBranchCurrentUserHandler
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
     * @param GetListCompanyBranchCurrentUserCommand $command
     * @return array
     */
    public function handle(GetListCompanyBranchCurrentUserCommand $command): array
    {
        try {
            $cache = Cache::tags([CompanyBranch::TAG_NAME->value])->has(
                CompanyBranch::LIST_COMPANY_BRANCH_CURRENT_USER->value .
                auth()->user()->id .
                $command->companyId
            );

            $companiesBranch = Cache::tags([CompanyBranch::TAG_NAME->value])->remember(
                CompanyBranch::LIST_COMPANY_BRANCH_CURRENT_USER->value .
                auth()->user()->id .
                $command->companyId,
                CacheTTL::REMEMBER->value,
                fn() => $this->companyRepository->findWithRelationships(
                    $command->companyId,
                    [
                        'companyBranches'
                    ]
                )
            );

            if(!empty($companiesBranch)){
                return [
                    'data' => CompanyProfileResource::make($companiesBranch),
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
