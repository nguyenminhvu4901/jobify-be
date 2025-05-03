<?php

namespace App\Services\JobSeries\JobLocation;

use App\DataTransferObjects\JobSeries\JobLocations\JobLocationData;
use App\Repositories\JobSeries\JobLocation\JobLocationRepository;
use Illuminate\Support\Facades\DB;

class JobLocationService
{
    public function __construct(
        protected JobLocationRepository $jobLocationRepository
    )
    {
    }

    /**
     * @param JobLocationData|array|null $storeJobLocationData
     * @param int $jobListingId
     * @return array
     */
    public function storeJobLocations(
        JobLocationData|null|array $storeJobLocationData,
        int                        $jobListingId
    ): array
    {
        return $this->jobLocationRepository->insertTransaction(
            $this->jobLocationsArray($storeJobLocationData, $jobListingId)
        );
    }

    /**
     * @param JobLocationData|array|null $jobLocationData
     * @param int $jobListingId
     * @return void
     */
    public function processUpsertJobLocations(
        JobLocationData|null|array $jobLocationData,
        int                        $jobListingId
    ): void
    {
        DB::beginTransaction();

        try {
            $jobLocationCollection = collect($jobLocationData);

            $idsDelete = $this->getJobLocationIdsToDel($jobLocationData, $jobListingId);
            $this->destroyJobLocations($idsDelete);

            $jobLocationCollection->filter(fn($item) => !empty($item->jobLocationId))
                ->each(fn($location) => $this->updateJobLocation($location, $jobListingId));

            $jobLocationsToInsert = $jobLocationCollection
                ->filter(fn($item) => empty($item->jobLocationId))
                ->values();

            if ($jobLocationsToInsert->isNotEmpty()) {
                $this->storeJobLocations($jobLocationsToInsert->all(), $jobListingId);
            }

            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
        }
    }

    /**
     * @param JobLocationData|array|null $JobLocationData
     * @param int $jobListingId
     * @return array
     */
    private function updateJobLocation(
        JobLocationData|null|array $JobLocationData,
        int                        $jobListingId
    ): array
    {
        return $this->jobLocationRepository->updateDataWithTransaction(
            $this->jobLocations($JobLocationData, $jobListingId),
            $JobLocationData->jobLocationId
        );
    }

    /**
     * @param array $jobLocationIds
     * @return array
     */
    public function destroyJobLocations(
        array $jobLocationIds
    ): array
    {
        return $this->jobLocationRepository->massDeleteTransaction('id', $jobLocationIds);
    }

    /**
     * @param JobLocationData|array|null $jobLocationData
     * @param int $jobListingId
     * @return array
     */
    private function jobLocationsArray(
        JobLocationData|array|null $jobLocationData,
        int                        $jobListingId
    ): array
    {
        $jobLocationArray = [];

        if(!empty($jobLocationData)){

            foreach ($jobLocationData as $data){
                $jobLocationArray[] = [
                    ...$this->jobLocations($data, $jobListingId),
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
        }

        return $jobLocationArray;
    }

    /**
     * @param JobLocationData|array|null $jobLocationData
     * @param int $jobListingId
     * @return array
     */
    private function jobLocations(
        JobLocationData|array|null $jobLocationData,
        int                        $jobListingId
    ): array
    {
        return [
            'job_listing_id' => $jobListingId,
            'branch_name' => $jobLocationData->branchName,
            'province_id' => $jobLocationData->provinceId,
            'district_id' => $jobLocationData->districtId,
            'ward_id' => $jobLocationData->wardId,
            'address' => $jobLocationData->address,
        ];
    }

    /**
     * @param JobLocationData|array|null $jobLocationData
     * @param int $jobListingId
     * @return array
     */
    private function getJobLocationIdsToDel(
        JobLocationData|null|array $jobLocationData,
        int                        $jobListingId
    ): array
    {
        $jobLocationIdsRq = collect($jobLocationData)->pluck('jobLocationId')->filter()->values();

        $jobLocationIdsDB = $this->jobLocationRepository->getJobLocationIdsByJobListingId($jobListingId);

        $idsToDelete = $jobLocationIdsDB->diff($jobLocationIdsRq);

        return $idsToDelete->values()->toArray();
    }
}
