<?php

namespace App\Enums\RouteNames\JobApplicationSeries;

enum ApplicationStatusEnum: string
{
    case PREFIX = 'applyJob.applicationStatus.';

    case TAG_NAME = 'applicationStatus';

    case TABLE = 'application_statuses';

    case LIST_APPLICATION_STATUS = 'getListApplicationStatuses';

    case UPDATE_JOB_APPLICATION_STATUS = 'updateJobApplicationStatus';

    case PENDING = '1';

    case REVIEWING = '2';

    case INTERVIEW = '3';

    case OFFER = '4';

    case HIRED = '5';

    case REJECTED = '6';

    case WITHDRAWN = '7';

    case SHORTLISTED = '8';

    case ASSESSMENT = '9';

    case ON_HOLD = '10';

    case NOT_SUITABLE = '11';

    case HIRED_VALUE = 'update hired_at';

    case REJECTED_AND_NOT_SUITABLE_VALUE = 'update reject_reason';

    public static function requiresRejectReason(?int $applicationStatusId): bool
    {
        return in_array($applicationStatusId, [
            ApplicationStatusEnum::REJECTED->value,
            ApplicationStatusEnum::NOT_SUITABLE->value,
        ]);
    }

    public static function requiresHiredAt(?int $applicationStatusId): bool
    {
        return $applicationStatusId == ApplicationStatusEnum::HIRED->value;
    }
}
