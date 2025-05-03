<?php

namespace App\Commands\CompanySeries\CompanyBranch\DestroyCompanyBranch;

use App\Repositories\CompanySeries\CompanyBranch\CompanyBranchRepository;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class DestroyCompanyBranchHandler
{
    public function __construct(
        protected CompanyBranchRepository $companyBranchRepository
    )
    {
    }

    /**
     * @param DestroyCompanyBranchCommand $command
     * @return array
     */
    public function handle(DestroyCompanyBranchCommand $command): array
    {
        try {
            $checkExist = $this->companyBranchRepository->checkExistByIdAndCompanyId(
                $command->companyBranchId,
                $command->companyId
            );

            if(!$checkExist){
                return [
                    'message' => __('messages.response.resource_not_found'),
                    'status_code' => ResponseAlias::HTTP_NOT_FOUND
                ];
            }

            $result = $this->companyBranchRepository->destroyDataWithTransaction(
                $command->companyBranchId
            );

            if ($result['success']) {
                return [
                    'companyBranchDestroy' => $result['success'],
                    'message' => __('messages.company.company_destroy_profile_success'),
                ];
            }

            return [
                'message' => $result['message'] ?? __('messages.company.company_destroy_profile_error'),
                'error' => $result['error'] ?? null,
                'status_code' => ResponseAlias::HTTP_INTERNAL_SERVER_ERROR
            ];
        }catch (\Exception $e){

            return [
                'message' => __('messages.company.company_destroy_profile_error'),
                'error' => $e,
                'status_code' => ResponseAlias::HTTP_INTERNAL_SERVER_ERROR
            ];
        }
    }
}
