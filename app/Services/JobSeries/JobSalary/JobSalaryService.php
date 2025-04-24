<?php

namespace App\Services\JobSeries\JobSalary;

use App\DataTransferObjects\JobSeries\JobSalaries\JobSalaryData;
use App\Repositories\JobSeries\JobListing\JobListingRepository;
use App\Repositories\JobSeries\JobSalary\JobSalaryRepository;

class JobSalaryService
{
    public function __construct(
        protected JobSalaryRepository $jobSalaryRepository,
        protected JobListingRepository $jobListingRepository,
    )
    {
    }

    /**
     * @param JobSalaryData|array|null $jobSalaryData
     * @return array|null
     */
    public function storeJobSalary(
        JobSalaryData|array|null $jobSalaryData): ?array
    {
        $jobSalary = null;
        if(!empty($jobSalaryData)){
            $jobSalary = $this->jobSalaryRepository->storeDataWithTransaction(
                $this->jobSalaryTransformer($jobSalaryData[0] ?? null)
            );
        }

        return $jobSalary;
    }

    /**
     * @param JobSalaryData|array|null $jobSalaryData
     * @param int $jobListingId
     * @return array|null
     */
    public function updateJobSalary(
        JobSalaryData|array|null $jobSalaryData,
        int $jobListingId
    ): ?array {
        $salaryData = $jobSalaryData[0] ?? null;

        if (!$salaryData) {
            return null;
        }

        if (!empty($salaryData->jobSalaryId)) {
            return $this->jobSalaryRepository->updateDataWithTransaction(
                $this->jobSalaryTransformer($salaryData),
                $salaryData->jobSalaryId
            );
        }

        $jobListing = $this->jobListingRepository->find($jobListingId);

        if (!empty($jobListing?->job_salary_id)) {
            $this->jobListingRepository->destroyDataWithTransaction(
                $jobListing->job_salary_id
            );
        }

        return $this->jobSalaryRepository->storeDataWithTransaction(
            $this->jobSalaryTransformer($salaryData)
        );
    }

    /**
     * @param JobSalaryData|null $data
     * @return array|null
     */
    private function jobSalaryTransformer(
        JobSalaryData|null $data
    ): ?array
    {
        if($data instanceof JobSalaryData){

            return [
                'currency_id' => $data->currencyId,
                'job_salary_type_id' => $data->jobSalaryTypeId,
                'from' => $data->from,
                'to' => $data->to
            ];
        }

        return null;
    }
}
