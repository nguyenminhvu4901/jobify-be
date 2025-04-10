<?php

namespace App\Enums\RouteNames\JobSeries;

enum JobListingEnum: string
{
    case PREFIX = 'job.job-listing.';

    case TAG_NAME = 'jobListings';

    case TABLE = 'job_listings';

    case LIST_ALL_JOBS = 'listAllJobs';

    case LIST_ALL_JOBS_BY_COMPANY = 'listAllJobsByCompany';

    case DETAIL_JOB = 'detailJob';

    case SUGGESTED_JOB = 'suggestedJob';
}
