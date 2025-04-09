<?php

namespace App\Enums\RouteNames\JobSeries;

enum JobSalaryTypeEnum: string
{
    case PREFIX = 'job.job-salary-type.';

    case TAG_NAME = 'jobSalaryType';

    case TABLE = 'job_salary_types';

    case LIST_ALL_JOB_SALARY_TYPE = 'listAllJobSalaryType';
}
