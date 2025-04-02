<?php

namespace App\Commands\CompanySeries\CompanyBranch\UpdateBranchCompany;

use App\Http\Resources\CompanySeries\CompanyBranch\CompanyBranchResource;
use App\Repositories\CompanySeries\CompanyBranch\CompanyBranchRepository;

class UpdateCompanyBranchHandler
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
     * @param UpdateCompanyBranchCommand $command
     * @return array
     */
    public function handle(UpdateCompanyBranchCommand $command): array
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
     * @param UpdateCompanyBranchCommand $command
     * @return array
     */
    private function prepareCompanyData(UpdateCompanyBranchCommand $command): array
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
