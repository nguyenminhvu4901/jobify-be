<?php

namespace App\Enums\RouteNames\JobSeries;

enum JobModerationStatusEnum: string
{
    case PREFIX = 'job.jobModerationStatus.';

    case TAG_NAME = 'jobModerationStatus';

    case TABLE = 'job_moderation_statuses';

    case LIST_ALL_JOB_MODERATION_STATUS = 'listAllJobModerationStatus';
}
