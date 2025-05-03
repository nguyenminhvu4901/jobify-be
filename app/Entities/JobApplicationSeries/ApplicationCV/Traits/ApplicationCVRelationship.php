<?php

namespace App\Entities\JobApplicationSeries\ApplicationCV\Traits;

use App\Entities\JobApplicationSeries\JobApplication\JobApplication;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait ApplicationCVRelationship
{
    public function jobApplications(): BelongsTo
    {
        return $this->belongsTo(JobApplication::class, 'job_application_id', 'id');
    }
}
