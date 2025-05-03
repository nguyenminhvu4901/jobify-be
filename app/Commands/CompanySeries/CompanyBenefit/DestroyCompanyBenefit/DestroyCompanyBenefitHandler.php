<?php

namespace App\Commands\CompanySeries\CompanyBenefit\DestroyCompanyBenefit;

use App\Repositories\CompanySeries\CompanyBenefit\CompanyBenefitRepository;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class DestroyCompanyBenefitHandler
{
    public function __construct(
        protected CompanyBenefitRepository $companyBenefitRepository
    ) {
    }

    public function handle(DestroyCompanyBenefitCommand $command): array
    {
        try {
            $checkExist = $this->companyBenefitRepository->checkExistByIdAndCompanyId(
                $command->companyBenefitId,
                $command->companyId
            );

            if (! $checkExist) {
                return [
                    'message' => __('messages.response.resource_not_found'),
                    'status_code' => ResponseAlias::HTTP_NOT_FOUND,
                ];
            }

            $result = $this->companyBenefitRepository->destroyDataWithTransaction(
                $command->companyBenefitId
            );

            if ($result['success']) {
                return [
                    'companyBenefitDestroy' => $result['success'],
                    'message' => __('messages.company.company_destroy_profile_success'),
                ];
            }

            return [
                'message' => $result['message'] ?? __('messages.company.company_destroy_profile_error'),
                'error' => $result['error'] ?? null,
                'status_code' => ResponseAlias::HTTP_INTERNAL_SERVER_ERROR,
            ];
        } catch (\Exception $e) {

            return [
                'message' => __('messages.company.company_destroy_profile_error'),
                'error' => $e,
                'status_code' => ResponseAlias::HTTP_INTERNAL_SERVER_ERROR,
            ];
        }
    }
}
