<?php

namespace App\Commands\CompanySeries\CompanyProfile\UpdateCompanyProfile;

use App\Http\Resources\CompanySeries\CompanyProfile\CompanyProfileWithUserDataResource;
use App\Repositories\CompanySeries\Company\CompanyRepository;

class UpdateCompanyProfileHandler
{
    public function __construct(
        protected CompanyRepository $companyRepository
    )
    {
    }

    public function handle(UpdateCompanyProfileCommand $command): array
    {
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

        if(!empty($command->operationTypes)){
            $this->companyRepository->syncOperationTypes($result['data'], $command->operationTypes);
        }

        if(!empty($command->businessSectors)){
            $this->companyRepository->syncBusinessSectors($result['data'], $command->businessSectors);
        }

        return [
            'data' => CompanyProfileWithUserDataResource::make($result['data']),
            'message' => __('messages.company.company_update_profile_success')
        ];
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
}
