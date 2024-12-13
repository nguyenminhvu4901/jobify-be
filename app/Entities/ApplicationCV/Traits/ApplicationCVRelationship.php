<?php

namespace App\Entities\ApplicationCV\Traits;

use App\Entities\JobApplication\JobApplication;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait ApplicationCVRelationship
{
    /**
     * @return BelongsTo
     */
    public function jobApplications(): BelongsTo
    {
        return $this->belongsTo(JobApplication::class, 'job_application_id', 'id');
    }
}
