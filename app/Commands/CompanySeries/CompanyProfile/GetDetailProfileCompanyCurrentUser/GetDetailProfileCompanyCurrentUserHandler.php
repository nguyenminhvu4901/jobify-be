<?php

namespace App\Commands\CompanySeries\CompanyProfile\GetDetailProfileCompanyCurrentUser;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\Company\CompanyProfileEnum;
use App\Http\Resources\CompanySeries\CompanyProfile\DetailInformationCompanyCurrentUserResource;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Cache;

class GetDetailProfileCompanyCurrentUserHandler
{
    public function __construct(
        protected UserRepository $userRepository
    ){}

    public function handle(): array
    {
        try {
            $cache = Cache::tags([CompanyProfileEnum::TAG_NAME->value])
                ->has(
                    CompanyProfileEnum::DETAIL_COMPANY_PROFILE_CURRENT_USER->value .
                    auth()?->user()?->id
                );

            $companyProfile = Cache::tags([CompanyProfileEnum::TAG_NAME->value])->remember(
                CompanyProfileEnum::DETAIL_COMPANY_PROFILE_CURRENT_USER->value .
                auth()?->user()?->id,
                CacheTTL::REMEMBER->value,
                fn() => $this->userRepository->findWithRelationships(
                    auth()?->user()?->id,
                    [
                        'status', 'company.gender',
                        'company.status',
                        'company.companyScale',
                        'company.companyBranches',
                        'company.companyWorkingDay',
                        'company.operationTypes',
                        'company.businessSectors',
                        'company.companyBenefits',
                    ]
                )
            );

            if(!empty($companyProfile)){
                return [
                    'data' => DetailInformationCompanyCurrentUserResource::make($companyProfile),
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
