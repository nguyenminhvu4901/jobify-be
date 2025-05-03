<?php

namespace App\Repositories\JobSeries\JobSalary;

use App\Entities\JobSeries\JobSalary\JobSalary;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class JobSalaryRepositoryEloquent extends BaseRepository implements JobSalaryRepository
{
    public function model(): string
    {
        return JobSalary::class;
    }

    public function getJobSalaryIdsByJobListingId(int $jobListingId): mixed
    {
        return $this->model->whereByJobListingId($jobListingId)->pluck('id')->values();
    }

    public function detachJobSalary(int $jobListingId, array $jobSalaryIds): array
    {
        DB::beginTransaction();

        try {
            $jobSalary = $this->model
                ->where('job_listing_id', $jobListingId)
                ->whereIn('id', $jobSalaryIds)
                ->delete();

            DB::commit();

            return [
                'success' => true,
                'message' => __('messages.response.delete_resource_success'),
            ];
        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'success' => false,
                'message' => __('messages.response.delete_resource_failed'),
                'error' => $e->getMessage(),
            ];
        }
    }
}
