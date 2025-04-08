<?php

namespace App\Enums\RouteNames\JobListing;

enum JobListingEnum: string
{
    case PREFIX = 'job.job-listing.';

    case TAG_NAME = 'jobListings';

    case TABLE = 'job_listings';
}
