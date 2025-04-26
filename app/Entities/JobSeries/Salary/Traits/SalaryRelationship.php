<?php

namespace App\Entities\JobSeries\Salary\Traits;

use App\Entities\JobSeries\Currency\Currency;
use App\Entities\JobSeries\JobListing\JobListing;
use App\Entities\JobSeries\JobSalary\JobSalary;
use App\Entities\JobSeries\JobSalaryType\JobSalaryType;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait SalaryRelationship
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
     * @return BelongsToMany
     */
    public function jobListings(): BelongsToMany
    {
        return $this->belongsToMany(JobListing::class, JobSalary::class);
    }
}
