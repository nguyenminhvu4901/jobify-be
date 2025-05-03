<?php

namespace App\Enums;

enum DefaultRole: string
{
    case ADMIN = 'admin';

    case JOBSEEKER = 'job_seeker';

    case RECRUITER = 'recruiter';

    public function getAdminType(): DefaultRole
    {
        return self::ADMIN;
    }

    public function getJobSeekerType(): DefaultRole
    {
        return self::JOBSEEKER;
    }

    public function getRecruiterType(): DefaultRole
    {
        return self::RECRUITER;
    }
}
