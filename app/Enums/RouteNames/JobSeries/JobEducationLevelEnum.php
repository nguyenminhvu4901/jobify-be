<?php

namespace App\Enums\RouteNames\JobSeries;

enum JobEducationLevelEnum: string
{
    case PREFIX = 'job.jobEducationLevel.';

    case TAG_NAME = 'jobEducationLevel';

    case TABLE = 'job_education_levels';

    case LIST_ALL_JOB_EDUCATION_LEVEL = 'listAllJobEducationLevel';
}
