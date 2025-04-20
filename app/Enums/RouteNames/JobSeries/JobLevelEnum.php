<?php

namespace App\Enums\RouteNames\JobSeries;

enum JobLevelEnum: string
{
    case PREFIX = 'job.jobLevel.';

    case TAG_NAME = 'jobLevel';

    case TABLE = 'job_levels';

    case LIST_ALL_JOB_LEVEL = 'listAllJobLevel';
}
