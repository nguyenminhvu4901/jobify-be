<?php

namespace App\Services\JobSeries\JobContact;

use App\DataTransferObjects\JobSeries\JobContacts\JobContactData;
use App\Repositories\JobSeries\JobContact\JobContactRepository;
use Illuminate\Support\Facades\DB;

class JobContactService
{
    /**
     * @param JobContactRepository $jobContactRepository
     */
    public function __construct(
        protected JobContactRepository $jobContactRepository
    )
    {
    }

    /**
     * @param JobContactData|array|null $storeJobContactData
     * @param int $jobListingId
     * @return array
     */
    public function storeJobContacts(
        JobContactData|null|array $storeJobContactData,
        int                       $jobListingId
    ): array
    {
        return $this->jobContactRepository->insertTransaction(
            $this->jobContactsArray($storeJobContactData, $jobListingId)
        );
    }

    /**
     * @param JobContactData|array|null $jobContactData
     * @param int $jobListingId
     * @return void
     */
    public function processUpsertJobContacts(
        JobContactData|null|array $jobContactData,
        int                       $jobListingId
    ): void
    {
        $jobContactCollection = collect($jobContactData);

        $idsDelete = $this->getJobLocationIdsToDel($jobContactData, $jobListingId);
        $this->destroyJobContacts($idsDelete);

        $jobContactCollection->filter(fn($item) => !empty($item->jobContactId))
            ->each(fn($contact) => $this->updateJobContact($contact, $jobListingId));

        $jobContactsToInsert = $jobContactCollection
            ->filter(fn($item) => empty($item->jobContactId))
            ->values();

        if ($jobContactsToInsert->isNotEmpty()) {
            $this->storeJobContacts($jobContactsToInsert->all(), $jobListingId);
        }
    }

    /**
     * @param JobContactData|array|null $jobContactData
     * @param int $jobListingId
     * @return array
     */
    private function updateJobContact(
        JobContactData|null|array $jobContactData,
        int                        $jobListingId
    ): array
    {
        return $this->jobContactRepository->updateDataWithTransaction(
            $this->jobContacts($jobContactData, $jobListingId),
            $jobContactData->jobContactId
        );
    }

    /**
     * @param array $jobContactIds
     * @return array
     */
    public function destroyJobContacts(
        array $jobContactIds
    ): array
    {
        return $this->jobContactRepository->massDeleteTransaction('id', $jobContactIds);
    }

    /**
     * @param JobContactData|array|null $storeJobContactData
     * @param int $jobListingId
     * @return array
     */
    private function jobContactsArray(
        JobContactData|array|null $storeJobContactData,
        int                       $jobListingId
    ): array
    {
        $jobContactArray = [];

        if(!empty($storeJobContactData)) {

            foreach ($storeJobContactData as $data){
                $jobContactArray[] = [
                    ...$this->jobContacts($data, $jobListingId),
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
        }

        return $jobContactArray;
    }

    /**
     * @param JobContactData|array|null $data
     * @param int $jobListingId
     * @return array
     */
    private function jobContacts(
        JobContactData|array|null $data,
        int                       $jobListingId
    ): array
    {
        return [
            'job_listing_id' => $jobListingId,
            'full_name' => $data->fullName,
            'email' => $data->email,
            'phone_number' => $data->phoneNumber,
        ];
    }

    /**
     * @param JobContactData|array|null $jobContactData
     * @param int $jobListingId
     * @return array
     */
    private function getJobLocationIdsToDel(
        JobContactData|null|array $jobContactData,
        int                        $jobListingId
    ): array
    {
        $jobContactIdsRq = collect($jobContactData)->pluck('jobContactId')->filter()->values();

        $jobContactIdsDB = $this->jobContactRepository->getJobContactIdsByJobListingId($jobListingId);

        $idsToDelete = $jobContactIdsDB->diff($jobContactIdsRq);

        return $idsToDelete->values()->toArray();
    }
}
