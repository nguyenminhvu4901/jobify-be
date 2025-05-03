<?php

namespace App\Commands\CompanySeries\CompanyBenefit\UpdateCompanyBenefit;

use App\Http\Resources\CompanySeries\CompanyBenefit\CompanyBenefitResource;
use App\Repositories\CompanySeries\CompanyBenefit\CompanyBenefitRepository;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class UpdateCompanyBenefitHandler
{
    /**
     * @param CompanyBenefitRepository $companyBenefitRepository
     */
    public function __construct(
        protected CompanyBenefitRepository $companyBenefitRepository
    )
    {
    }

    /**
     * @param UpdateCompanyBenefitCommand $command
     * @return array
     */
    public function handle(UpdateCompanyBenefitCommand $command): array
    {
        try {
            $result = $this->companyBenefitRepository->updateDataWithTransaction(
                $this->prepareCompanyData($command),
                $command->companyBenefitId
            );

            if(!$result['success']){

                return [
                    'message' => __('messages.company.company_update_profile_error'),
                    'error' => $result['error'] ?? null
                ];
            }

            return [
                'data' => CompanyBenefitResource::make($result['data']),
                'message' => __('messages.company.company_update_profile_success')
            ];
        }catch (\Exception $e){

            return [
                'message' => __('messages.company.company_update_profile_error'),
                'error' => $e,
                'status_code' => ResponseAlias::HTTP_INTERNAL_SERVER_ERROR
            ];
        }
    }

    /**
     * @param UpdateCompanyBenefitCommand $command
     * @return array
     */
    private function prepareCompanyData(UpdateCompanyBenefitCommand $command): array
    {
        return [
            'benefit_name' => $command->benefitName,
            'description' => $command->benefitDescription,
        ];
    }
}
