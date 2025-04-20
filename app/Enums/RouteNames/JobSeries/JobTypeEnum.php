<?php

namespace App\Enums\RouteNames\JobSeries;

enum JobTypeEnum: string
{
    case PREFIX = 'job.jobType.';

    case TAG_NAME = 'jobType';

    case TABLE = 'job_types';

    case LIST_ALL_JOB_TYPE = 'listAllJobType';
}
