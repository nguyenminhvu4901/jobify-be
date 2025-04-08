<?php

namespace App\Enums\RouteNames\JobSeries;

enum JobExperienceEnum: string
{
    case PREFIX = 'job.job-experience.';

    case TAG_NAME = 'jobExperience';

    case TABLE = 'job_experiences';

    case LIST_ALL_JOB_EXPERIENCE = 'listAllJobExperience';
}
