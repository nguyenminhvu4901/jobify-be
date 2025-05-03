<?php

namespace App\Enums;

enum DefaultRole: string
{
    case ADMIN = 'admin';

    case JOBSEEKER = 'job_seeker';

    case RECRUITER = 'recruiter';

    /**
     * @return DefaultRole
     */
    public function getAdminType(): DefaultRole
    {
        return self::ADMIN;
    }

    /**
     * @return DefaultRole
     */
    public function getJobSeekerType(): DefaultRole
    {
        return self::JOBSEEKER;
    }

    /**
     * @return DefaultRole
     */
    public function getRecruiterType(): DefaultRole
    {
        return self::RECRUITER;
    }
}
