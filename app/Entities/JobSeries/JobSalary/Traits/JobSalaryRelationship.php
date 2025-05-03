<?php

namespace App\Entities\JobSeries\JobSalary\Traits;

use App\Entities\JobSeries\Currency\Currency;
use App\Entities\JobSeries\JobListing\JobListing;
use App\Entities\JobSeries\JobSalaryType\JobSalaryType;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait JobSalaryRelationship
{
    public function jobListing(): BelongsTo
    {
        return $this->belongsTo(JobListing::class, 'job_listing_id', 'id');
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }

    public function jobSalaryType(): BelongsTo
    {
        return $this->belongsTo(JobSalaryType::class, 'job_salary_type_id', 'id');
    }
}
