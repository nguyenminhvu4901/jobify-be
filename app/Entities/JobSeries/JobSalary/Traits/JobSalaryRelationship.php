<?php

namespace App\Entities\JobSeries\JobSalary\Traits;

use App\Entities\JobSeries\JobListing\JobListing;
use App\Entities\JobSeries\Salary\Salary;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait JobSalaryRelationship
{
    /**
     * @return BelongsTo
     */
    public function salaries(): BelongsTo
    {
        return $this->belongsTo(Salary::class);
    }
    /**
     * @return BelongsTo
     */
    public function jobListing(): BelongsTo
    {
        return $this->belongsTo(JobListing::class, 'job_listing_id', 'id');
    }
}
