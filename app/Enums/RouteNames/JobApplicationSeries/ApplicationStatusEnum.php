<?php

namespace App\Enums\RouteNames\JobApplicationSeries;

enum ApplicationStatusEnum: string
{
    case PREFIX = 'applyJob.applicationStatus.';

    case TAG_NAME = 'applicationStatus';

    case TABLE = 'application_statuses';

    case LIST_APPLICATION_STATUS = 'getListApplicationStatuses';

    case PENDING = '1';
}
