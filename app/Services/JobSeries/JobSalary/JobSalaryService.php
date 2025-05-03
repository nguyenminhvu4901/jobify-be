<?php

namespace App\Services\JobSeries\JobSalary;

use App\DataTransferObjects\JobSeries\Salaries\SalaryData;
use App\Repositories\JobSeries\JobSalary\JobSalaryRepository;

class JobSalaryService
{
    public function __construct(
        protected JobSalaryRepository $jobSalaryRepository
    )
    {
    }

    /**
     * @param array|null $jobSalaryData
     * @param int $jobListingId
     * @return void
     */
    public function massStoreJobSalary(
        array|null $jobSalaryData,
        int $jobListingId
    ): void
    {
        foreach ($jobSalaryData as $data){
            $this->storeJobSalary($data, $jobListingId);
        }
    }

    /**
     * @param SalaryData $jobSalaryData
     * @param int $jobListingId
     * @return void
     */
    private function storeJobSalary(
        SalaryData $jobSalaryData,
        int $jobListingId
    ): void
    {
        $this->jobSalaryRepository->storeDataWithTransaction(
            $this->salariesTransformer($jobSalaryData, $jobListingId),
            ['jobListings']
        );
    }

    /**
     * @param array|null $jobSalaryData
     * @param int $jobListingId
     * @return void
     */
    public function processUpdateJobSalary(
        array|null $jobSalaryData,
        int        $jobListingId
    ): void {
        $idsDelete = $this->getJobSalaryIdsToDel($jobSalaryData, $jobListingId);
        $this->deleteJobSalary($idsDelete);

        foreach ($jobSalaryData as $data){
            if(!empty($data->salaryId)){
                $this->updateJobSalary($data, $jobListingId);
            }else{
                $this->storeJobSalary($data, $jobListingId);
            }
        }
    }

    /**
     * @param SalaryData $jobSalaryData
     * @param int $jobListingId
     * @return array
     */
    public function updateJobSalary(
        SalaryData $jobSalaryData,
        int        $jobListingId
    ): array
    {
        return $this->jobSalaryRepository->updateDataWithTransaction(
            $this->salariesTransformer($jobSalaryData, $jobListingId),
            $jobSalaryData->salaryId
        );
    }

    /**
     * @param array $jobSalaryIds
     * @return array
     */
    public function deleteJobSalary(
        array $jobSalaryIds,
    ): array
    {

        return $this->jobSalaryRepository->massDeleteTransaction('id', $jobSalaryIds);
    }

    /**
     * @param array $jobSalaryData
     * @param int $jobListingId
     * @return array
     */
    private function getJobSalaryIdsToDel(
        array $jobSalaryData,
        int   $jobListingId
    ): array
    {
        $jobSalaryIdsRq = collect($jobSalaryData)->pluck('jobSalaryId')->filter()->values();

        $jobSalaryIdsDB = $this->jobSalaryRepository->getJobSalaryIdsByJobListingId($jobListingId);

        $idsToDelete = $jobSalaryIdsDB->diff($jobSalaryIdsRq);

        return $idsToDelete->values()->toArray();
    }

    /**
     * @param SalaryData|null $jobSalaryData
     * @param int $jobListingId
     * @return array
     */
    private function salariesTransformer(
        SalaryData|null $jobSalaryData,
        int   $jobListingId
    ): array
    {
        return [
            'job_listing_id' => $jobListingId,
            'currency_id' => $jobSalaryData->currencyId,
            'job_salary_type_id' => $jobSalaryData->jobSalaryTypeId,
            'from' => $jobSalaryData->from,
            'to' => $jobSalaryData->to,
        ];
    }
}
