<?php

namespace App\Commands\JobSeries\JobListing\GetListAllJobByCompany;

use App\Enums\RouteNames\JobSeries\JobListingEnum;
use App\Enums\TTL\CacheTTL;
use App\Http\Resources\JobSeries\JobListings\JobListingResource;
use App\Repositories\JobSeries\JobListing\JobListingRepository;
use Illuminate\Support\Facades\Cache;

class GetListAllJobByCompanyHandler
{
    /**
     * @param JobListingRepository $jobListingRepository
     */
    public function __construct(
        protected JobListingRepository $jobListingRepository
    )
    {
    }

    /**
     * @param GetListAllJobByCompanyCommand $command
     * @return array
     */
    public function handle(GetListAllJobByCompanyCommand $command): array
    {
        try {
            $cache = Cache::tags([JobListingEnum::TAG_NAME->value])
                ->has(
                    generateCacheName(
                        JobListingEnum::LIST_ALL_JOBS_BY_COMPANY->value,
                        $command
                    )
                );

            $jobListingsByCompany = Cache::tags([JobListingEnum::TAG_NAME->value])->remember(
                generateCacheName(
                    JobListingEnum::LIST_ALL_JOBS_BY_COMPANY->value,
                    $command
                ),
                CacheTTL::REMEMBER->value,
                fn() => $this->jobListingRepository->getJobListingsByCompanyId(
                    $command->companyId,
                    [
                        'companies', 'gender', 'status', 'jobVisibilityStatus', 'jobModerationStatus',
                        'jobListingDetail',
                        'jobSalaries' => fn ($query) => $query->with(['currency', 'jobSalaryType']),
                        'positions', 'jobContact',
                        'jobLocation' => fn ($query) => $query->with(['province', 'district', 'ward']),
                        'jobAgeRanges', 'jobTypes', 'jobLevels', 'jobExperiences', 'jobEducationLevels'
                    ]
                )
            );

            return [
                'data' => JobListingResource::collection($jobListingsByCompany),
                'message' => __('messages.job.job_get_info_success'),
                'cache' => $cache,
                'pagination' => formatPaginationData($jobListingsByCompany)
            ];
        }catch (\Exception $e){

            return [
                'message' => __('messages.job.job_get_info_error'),
                'error' => $e
            ];
        }
    }
}
