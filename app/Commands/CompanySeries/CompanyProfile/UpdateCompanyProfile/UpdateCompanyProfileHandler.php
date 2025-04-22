<?php

namespace App\Commands\CompanySeries\CompanyProfile\UpdateCompanyProfile;

use App\Entities\CompanySeries\Company\Company;
use App\Http\Resources\CompanySeries\CompanyProfile\CompanyProfileWithUserDataResource;
use App\Repositories\CompanySeries\Company\CompanyRepository;

class UpdateCompanyProfileHandler
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
     * @param UpdateCompanyProfileCommand $command
     * @return array
     */
    public function handle(UpdateCompanyProfileCommand $command): array
    {
        try {
            $result = $this->companyRepository->updateDataWithTransaction(
                $this->prepareCompanyData($command),
                $command->companyId
            );

            if(!$result['success']){

                return [
                    'message' => __('messages.company.company_update_profile_error'),
                    'error' => $result['error'] ?? null
                ];
            }

            $result['data']->load(
                [
                    'user', 'gender', 'status', 'companyScale', 'companyBranches', 'companyWorkingDay',
                    'operationTypes', 'businessSectors'
                ]
            );

            $this->syncCompany($result['data'], $command);

            return [
                'data' => CompanyProfileWithUserDataResource::make($result['data']),
                'message' => __('messages.company.company_update_profile_success')
            ];
        }catch (\Exception $e){

            return [
                'message' => __('messages.company.company_update_profile_error'),
                'error' => $e
            ];
        }

    }

    /**
     * @param UpdateCompanyProfileCommand $command
     * @return array
     */
    private function prepareCompanyData(UpdateCompanyProfileCommand $command): array
    {
        return [
            'name' => $command->companyName,
            'company_scale_id' => $command->companyScaleId,
            'gender_id' => $command->genderId,
            'company_working_day_id'=> $command->companyWorkingDayId,
            'website' => $command->website,
            'description' => $command->description,
            'tax_code' => $command->taxCode
        ];
    }

    /**
     * @param Company $company
     * @param UpdateCompanyProfileCommand $command
     * @return void
     */
    private function syncCompany(Company $company, UpdateCompanyProfileCommand $command): void
    {
        $this->companyRepository->syncOperationTypes($company, $command->operationTypes);
        $this->companyRepository->syncBusinessSectors($company, $command->businessSectors);
    }
}
