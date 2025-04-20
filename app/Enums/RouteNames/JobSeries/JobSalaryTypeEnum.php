<?php

namespace App\Enums\RouteNames\JobSeries;

enum JobSalaryTypeEnum: string
{
    case PREFIX = 'job.jobSalaryType.';

    case TAG_NAME = 'jobSalaryType';

    case TABLE = 'job_salary_types';

    case LIST_ALL_JOB_SALARY_TYPE = 'listAllJobSalaryType';
}
