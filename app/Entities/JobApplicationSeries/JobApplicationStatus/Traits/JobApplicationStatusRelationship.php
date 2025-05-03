<?php

namespace App\Entities\JobApplicationSeries\JobApplicationStatus\Traits;

use App\Entities\JobApplicationSeries\ApplicationStatus\ApplicationStatus;
use App\Entities\JobApplicationSeries\JobApplication\JobApplication;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait JobApplicationStatusRelationship
{
    public function applicationStatuses(): BelongsTo
    {
        return $this->belongsTo(ApplicationStatus::class, 'application_status_id', 'id');
    }

    public function jobApplications(): BelongsTo
    {
        return $this->belongsTo(JobApplication::class, 'job_application_id', 'id');
    }
}
