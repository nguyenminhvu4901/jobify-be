<?php

namespace App\Enums\RouteNames\ApplyJob;

enum JobApplicationEnum: string
{
    case PREFIX = 'applyJob.jobApplication.';

    case TAG_NAME = 'jobApplication';

    case TABLE = 'job_applications';
}
