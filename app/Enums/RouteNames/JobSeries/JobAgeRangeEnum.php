<?php

namespace App\Enums\RouteNames\JobSeries;

enum JobAgeRangeEnum: string
{
    case PREFIX = 'job.job-age-range.';

    case TAG_NAME = 'jobAgeRange';

    case TABLE = 'job_age_ranges';

    case LIST_ALL_JOB_AGE_RANGE = 'listAllJobAgeRange';
}
