<?php

namespace App\Enums\RouteNames\JobSeries;

enum JobVisibilityStatusEnum: string
{
    case PREFIX = 'job.jobVisibilityStatus.';

    case TAG_NAME = 'jobVisibilityStatus';

    case TABLE = 'job_visibility_statuses';

    case LIST_ALL_JOB_VISIBILITY_STATUS = 'listAllJobVisibilityStatus';
}
