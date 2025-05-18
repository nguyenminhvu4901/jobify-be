<?php

namespace App\Repositories\JobSeries\JobListing;

use App\Entities\JobSeries\JobListing\JobListing;
use App\Enums\RouteNames\JobSeries\JobModerationStatusEnum;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use JeroenG\Explorer\Domain\Query\QueryProperties\TrackTotalHits;
use JeroenG\Explorer\Domain\Syntax\Matching;
use JeroenG\Explorer\Domain\Syntax\Nested;

class JobListingRepositoryEloquent extends BaseRepository implements JobListingRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return JobListing::class;
    }

    /**
     * @param JobListing $jobListing
     * @return array
     */
    public function syncStoreJobModerationStatus(JobListing $jobListing): array
    {
        return $jobListing->jobModerationStatus()->sync([JobModerationStatusEnum::PENDING->value]);
    }

    /**
     * @param $companyId
     * @param array $relationships
     * @return mixed
     */
    public function getJobListingsByCompanyId($companyId, array $relationships = []): mixed
    {
        return $this->model->withRelationships($relationships)->whereByCompanyId($companyId)->get();
    }

    /**
     * @param int $companyId
     * @param int $jobListingId
     * @return mixed
     */
    public function checkExistsByCompanyIdAndJobListingId(int $companyId, int $jobListingId): mixed
    {
        return $this->model->checkExistCompanyIdAndJobId(
            $companyId,
            $jobListingId
        );
    }

    public function searchAndFilterJob(array $data)
    {
        $a = $this->model->search($data['search'])
            ->field('job_listing_detail123.description123')
            ->property(TrackTotalHits::all())

            ->paginate(100);

        dd($a);
    }
}
