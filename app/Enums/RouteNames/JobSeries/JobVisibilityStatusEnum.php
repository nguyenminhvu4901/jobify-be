<?php

namespace App\Enums\RouteNames\JobSeries;

enum JobVisibilityStatusEnum: string
{
    case PREFIX = 'job.jobVisibilityStatus.';

    case TAG_NAME = 'jobVisibilityStatus';

    case TABLE = 'job_visibility_statuses';

    case LIST_ALL_JOB_VISIBILITY_STATUS = 'listAllJobVisibilityStatus';

    case DRAFT = '1';

    case PUBLISHED = '2';

    case PAUSED = '3';

    case EXPIRED = '4';

    case CLOSED = '5';
}
