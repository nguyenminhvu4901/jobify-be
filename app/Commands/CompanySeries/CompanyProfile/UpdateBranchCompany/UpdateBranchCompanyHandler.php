<?php

namespace App\Commands\CompanySeries\CompanyProfile\UpdateBranchCompany;

use App\Http\Resources\CompanySeries\CompanyBranch\CompanyBranchResource;
use App\Http\Resources\CompanySeries\CompanyProfile\CompanyProfileWithUserDataResource;
use App\Repositories\CompanySeries\CompanyBranch\CompanyBranchRepository;

class UpdateBranchCompanyHandler
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
     * @param UpdateBranchCompanyCommand $command
     * @return array
     */
    public function handle(UpdateBranchCompanyCommand $command): array
    {
        $result = $this->companyBranchRepository->updateDataWithTransaction(
            $this->prepareCompanyData($command),
            $command->companyBranchId
        );

        if(!$result['success']){

            return [
                'message' => __('messages.company.company_update_profile_error'),
                'error' => $result['error'] ?? null
            ];
        }

        $result['data']->load(
            ['province', 'district', 'ward', 'company']
        );

        return [
            'data' => CompanyBranchResource::make($result['data']),
            'message' => __('messages.company.company_update_profile_success')
        ];
    }

    /**
     * @param UpdateBranchCompanyCommand $command
     * @return array
     */
    private function prepareCompanyData(UpdateBranchCompanyCommand $command): array
    {
        return [
            'branch_name' => $command->branchName,
            'province_id' => $command->provinceId,
            'district_id' => $command->districtId,
            'ward_id' => $command->wardId,
            'address' => $command->address
        ];
    }
}
