<?php

namespace App\Enums\RouteNames\JobSeries;

enum JobListingEnum: string
{
    case PREFIX = 'job.jobListing.';

    case TAG_NAME = 'jobListings';

    case TABLE = 'job_listings';

    case LIST_ALL_JOBS = 'listAllJobs';

    case LIST_ALL_JOBS_BY_COMPANY = 'listAllJobsByCompany';

    case DETAIL_JOB_BY_JOB_ID = 'detailJobByJobId';

    case SUGGESTED_JOB = 'suggestedJob';

    case STORE_JOB = 'storeJob';

    case UPDATE_JOB = 'updateJob';

    case UPDATE_JOB_ACTIVE_STATUS = 'updateJobActiveStatus';

    case DESTROY_JOB = 'destroyJob';
}
