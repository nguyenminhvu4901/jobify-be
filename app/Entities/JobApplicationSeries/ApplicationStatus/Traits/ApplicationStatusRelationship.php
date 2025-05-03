<?php

namespace App\Entities\JobApplicationSeries\ApplicationStatus\Traits;

use App\Entities\JobApplicationSeries\JobApplicationStatus\JobApplicationStatus;
use App\Entities\JobSeries\JobListing\JobListing;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait ApplicationStatusRelationship
{
    /**
     * @return BelongsToMany
     */
    public function jobListings(): BelongsToMany
    {
        return $this->belongsToMany(JobListing::class, JobApplicationStatus::class);
    }
}
