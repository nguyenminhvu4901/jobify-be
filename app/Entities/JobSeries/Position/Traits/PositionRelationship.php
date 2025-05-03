<?php

namespace App\Entities\JobSeries\Position\Traits;

use App\Entities\JobSeries\JobListing\JobListing;
use App\Entities\JobSeries\JobPosition\JobPosition;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait PositionRelationship
{
    public function jobListings(): BelongsToMany
    {
        return $this->belongsToMany(
            JobListing::class,
            JobPosition::class
        )->withTimestamps();
    }
}
