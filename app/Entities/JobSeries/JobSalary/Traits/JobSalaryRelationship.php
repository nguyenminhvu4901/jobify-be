<?php

namespace App\Entities\JobSeries\JobSalary\Traits;

use App\Entities\JobSeries\Currency\Currency;
use App\Entities\JobSeries\JobListing\JobListing;
use App\Entities\JobSeries\JobSalaryType\JobSalaryType;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait JobSalaryRelationship
{
    /**
     * @return BelongsTo
     */
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function jobSalaryType(): BelongsTo
    {
        return $this->belongsTo(JobSalaryType::class, 'job_salary_type_id', 'id');
    }

    /**
     * @return HasOne
     */
    public function jobListing(): HasOne
    {
        return $this->hasOne(JobListing::class);
    }
}
