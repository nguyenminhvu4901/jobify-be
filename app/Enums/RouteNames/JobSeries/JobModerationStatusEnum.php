<?php

namespace App\Enums\RouteNames\JobSeries;

enum JobModerationStatusEnum: string
{
    case PREFIX = 'job.jobModerationStatus.';

    case TAG_NAME = 'jobModerationStatus';

    case TABLE = 'job_moderation_statuses';

    case LIST_ALL_JOB_MODERATION_STATUS = 'listAllJobModerationStatus';

    case PENDING = '1';

    case APPROVED = '2';

    case REJECTED = '3';

    case NEEDS_REVISION = '4';
}
