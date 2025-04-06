<?php

namespace App\Commands\CompanySeries\CompanyBenefit\StoreCompanyBenefit;

use App\Http\Resources\CompanySeries\CompanyBenefit\CompanyBenefitResource;
use App\Repositories\CompanySeries\CompanyBenefit\CompanyBenefitRepository;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class StoreCompanyBenefitHandler
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
     * @param StoreCompanyBenefitCommand $command
     * @return array
     */
    public function handle(StoreCompanyBenefitCommand $command): array
    {
        try {
            $result = $this->companyBenefitRepository->storeDataWithTransaction(
                $this->prepareCompanyData($command)
            );

            if(!$result['success']){

                return [
                    'message' => __('messages.company.company_update_profile_error'),
                    'error' => $result['error'] ?? null
                ];
            }

            $result['data']->load('companies');

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
     * @param StoreCompanyBenefitCommand $command
     * @return array
     */
    private function prepareCompanyData(StoreCompanyBenefitCommand $command): array
    {
        return [
            'company_id' => $command->companyId,
            'benefit_name' => $command->benefitName,
            'description' => $command->benefitDescription,
        ];
    }
}
