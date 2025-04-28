<?php

namespace App\Enums\RouteNames\JobApplicationSeries;

enum JobApplicationEnum: string
{
    case PREFIX = 'applyJob.jobApplication.';

    case TAG_NAME = 'jobApplication';

    case TABLE = 'job_applications';

    case DETAIL_JOB_APPLICATION_JOB_SEEKER = 'detailJobApplicationJobSeeker';

    case LIST_JOB_APPLICATION_JOB_SEEKER = 'listJobApplicationJobSeeker';

    case LIST_JOB_SEEKER_APPLY_JOB = 'listJobSeekerApplyJob';
}
