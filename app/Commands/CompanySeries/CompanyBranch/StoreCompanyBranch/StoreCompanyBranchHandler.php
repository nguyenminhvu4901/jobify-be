<?php

namespace App\Commands\CompanySeries\CompanyBranch\StoreCompanyBranch;

use App\Http\Resources\CompanySeries\CompanyBranch\CompanyBranchResource;
use App\Repositories\CompanySeries\CompanyBranch\CompanyBranchRepository;

class StoreCompanyBranchHandler
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
     * @param StoreCompanyBranchCommand $command
     * @return array
     */
    public function handle(StoreCompanyBranchCommand $command): array
    {
        $result = $this->companyBranchRepository->storeDataWithTransaction(
            $this->prepareCompanyData($command)
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
     * @param StoreCompanyBranchCommand $command
     * @return array
     */
    private function prepareCompanyData(StoreCompanyBranchCommand $command): array
    {
        return [
            'company_id' => $command->companyId,
            'branch_name' => $command->branchName,
            'province_id' => $command->provinceId,
            'district_id' => $command->districtId,
            'ward_id' => $command->wardId,
            'address' => $command->address
        ];
    }
}
