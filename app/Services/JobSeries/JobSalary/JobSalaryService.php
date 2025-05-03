<?php

namespace App\Services\JobSeries\JobSalary;

use App\DataTransferObjects\JobSeries\Salaries\SalaryData;
use App\Repositories\JobSeries\JobSalary\JobSalaryRepository;

class JobSalaryService
{
    public function __construct(
        protected JobSalaryRepository $jobSalaryRepository
    ) {
    }

    public function massStoreJobSalary(
        ?array $jobSalaryData,
        int $jobListingId
    ): void {
        foreach ($jobSalaryData as $data) {
            $this->storeJobSalary($data, $jobListingId);
        }
    }

    private function storeJobSalary(
        SalaryData $jobSalaryData,
        int $jobListingId
    ): void {
        $this->jobSalaryRepository->storeDataWithTransaction(
            $this->salariesTransformer($jobSalaryData, $jobListingId),
            ['jobListings']
        );
    }

    public function processUpdateJobSalary(
        ?array $jobSalaryData,
        int $jobListingId
    ): void {
        $idsDelete = $this->getJobSalaryIdsToDel($jobSalaryData, $jobListingId);
        $this->deleteJobSalary($idsDelete);

        foreach ($jobSalaryData as $data) {
            if (! empty($data->salaryId)) {
                $this->updateJobSalary($data, $jobListingId);
            } else {
                $this->storeJobSalary($data, $jobListingId);
            }
        }
    }

    public function updateJobSalary(
        SalaryData $jobSalaryData,
        int $jobListingId
    ): array {
        return $this->jobSalaryRepository->updateDataWithTransaction(
            $this->salariesTransformer($jobSalaryData, $jobListingId),
            $jobSalaryData->salaryId
        );
    }

    public function deleteJobSalary(
        array $jobSalaryIds,
    ): array {

        return $this->jobSalaryRepository->massDeleteTransaction('id', $jobSalaryIds);
    }

    private function getJobSalaryIdsToDel(
        array $jobSalaryData,
        int $jobListingId
    ): array {
        $jobSalaryIdsRq = collect($jobSalaryData)->pluck('jobSalaryId')->filter()->values();

        $jobSalaryIdsDB = $this->jobSalaryRepository->getJobSalaryIdsByJobListingId($jobListingId);

        $idsToDelete = $jobSalaryIdsDB->diff($jobSalaryIdsRq);

        return $idsToDelete->values()->toArray();
    }

    private function salariesTransformer(
        ?SalaryData $jobSalaryData,
        int $jobListingId
    ): array {
        return [
            'job_listing_id' => $jobListingId,
            'currency_id' => $jobSalaryData->currencyId,
            'job_salary_type_id' => $jobSalaryData->jobSalaryTypeId,
            'from' => $jobSalaryData->from,
            'to' => $jobSalaryData->to,
        ];
    }
}
