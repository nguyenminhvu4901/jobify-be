<?php

namespace App\Repositories\JobApplicationSeries\JobApplication;

use App\Entities\JobApplicationSeries\JobApplication\JobApplication;
use App\Enums\Paginate\PaginateEnum;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class JobApplicationRepositoryEloquent extends BaseRepository implements JobApplicationRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return JobApplication::class;
    }

    /**
     * @param int $jobApplicationId
     * @param int $userId
     * @param int $jobListingId
     * @param array|string $relationships
     * @return mixed
     */
    public function findByUserIdAndJobIdWithRelationships(
        int $jobApplicationId, int $userId, int $jobListingId, array|string $relationships
    ): mixed
    {
        return $this->model->with($relationships)
            ->whereUserIdAndJobListingId($userId, $jobListingId)
            ->find($jobApplicationId);
    }

    /**
     * @param int $userId
     * @param array|string $relationships
     * @param null $limit
     * @return LengthAwarePaginator
     */
    public function getByUserIdAndJobIdWithRelationships(
        int $userId, array|string $relationships, $limit = null,
    ): LengthAwarePaginator
    {
        return $this->model->with($relationships)
            ->where('user_id', $userId)
            ->latest()
            ->paginate( $limit ?? PaginateEnum::PAGINATE_DEFAULT->value);
    }

    public function getByJobListingIdAndJobIdWithRelationships(int $jobListingId, array|string $relationships, $limit = null,): mixed
    {
        return $this->model->with($relationships)
            ->where('job_listing_id', $jobListingId)
            ->latest()
            ->paginate( $limit ?? PaginateEnum::PAGINATE_DEFAULT->value);
    }
}
