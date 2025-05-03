<?php

namespace App\Commands\CompanySeries\CompanyBranch\StoreCompanyBranch;

use App\Http\Resources\CompanySeries\CompanyBranch\CompanyBranchResource;
use App\Repositories\CompanySeries\CompanyBranch\CompanyBranchRepository;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class StoreCompanyBranchHandler
{
    public function __construct(
        protected CompanyBranchRepository $companyBranchRepository
    ) {
    }

    public function handle(StoreCompanyBranchCommand $command): array
    {
        try {
            $result = $this->companyBranchRepository->storeDataWithTransaction(
                $this->prepareCompanyData($command)
            );

            if (! $result['success']) {

                return [
                    'message' => __('messages.company.company_update_profile_error'),
                    'error' => $result['error'] ?? null,
                ];
            }

            return [
                'data' => CompanyBranchResource::make($result['data']),
                'message' => __('messages.company.company_update_profile_success'),
            ];
        } catch (\Exception $e) {

            return [
                'message' => __('messages.company.company_update_profile_error'),
                'error' => $e,
                'status_code' => ResponseAlias::HTTP_INTERNAL_SERVER_ERROR,
            ];
        }
    }

    private function prepareCompanyData(StoreCompanyBranchCommand $command): array
    {
        return [
            'company_id' => $command->companyId,
            'branch_name' => $command->branchName,
            'province_id' => $command->provinceId,
            'district_id' => $command->districtId,
            'ward_id' => $command->wardId,
            'address' => $command->address,
        ];
    }
}
