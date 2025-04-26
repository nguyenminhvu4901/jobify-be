<?php

namespace App\Services\JobSeries\JobSalary;

use App\DataTransferObjects\JobSeries\Salaries\SalaryData;
use App\Repositories\JobSeries\JobListing\JobListingRepository;
use App\Repositories\JobSeries\JobSalary\JobSalaryRepository;
use App\Repositories\JobSeries\Salary\SalaryRepository;

class JobSalaryService
{
    public function __construct(
        protected SalaryRepository $salaryRepository,
        protected JobSalaryRepository $jobSalaryRepository,
        protected JobListingRepository $jobListingRepository,
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
        $salary = $this->salaryRepository->storeDataWithTransaction(
            $this->salariesTransformer($jobSalaryData),
            ['jobListings']
        );

        $salary['data']->jobListings()->attach($jobListingId, [
            'created_at' => now(),
            'updated_at' => now()
        ]);
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
        $this->deleteJobSalary($idsDelete, $jobListingId);

        foreach ($jobSalaryData as $data){
            if(!empty($data->salaryId)){
                $this->updateJobSalary($data);
            }else{
                $this->storeJobSalary($data, $jobListingId);
            }
        }
    }

    /**
     * @param SalaryData $jobSalaryData
     * @return array
     */
    public function updateJobSalary(
        SalaryData $jobSalaryData
    ): array
    {
        return $this->salaryRepository->updateDataWithTransaction(
            $this->salariesTransformer($jobSalaryData),
            $jobSalaryData->salaryId
        );
    }

    /**
     * @param array $jobSalaryIds
     * @param int $jobListingId
     * @return array
     */
    public function deleteJobSalary(
        array $jobSalaryIds,
        int $jobListingId
    ): array
    {

        $this->jobSalaryRepository->detachJobSalary($jobListingId, $jobSalaryIds);
        return $this->salaryRepository->massDeleteTransaction('id', $jobSalaryIds);
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
        $jobSalaryIdsRq = collect($jobSalaryData)->pluck('salaryId')->filter()->values();

        $jobSalaryIdsDB = $this->jobSalaryRepository->getJobSalaryIdsByJobListingId($jobListingId);

        $idsToDelete = $jobSalaryIdsDB->diff($jobSalaryIdsRq);

        return $idsToDelete->values()->toArray();
    }

    /**
     * @param SalaryData|null $jobSalaryData
     * @return array
     */
    private function salariesTransformer(
        SalaryData|null $jobSalaryData
    ): array
    {
        return [
            'currency_id' => $jobSalaryData->currencyId,
            'job_salary_type_id' => $jobSalaryData->jobSalaryTypeId,
            'from' => $jobSalaryData->from,
            'to' => $jobSalaryData->to,
        ];
    }
}
