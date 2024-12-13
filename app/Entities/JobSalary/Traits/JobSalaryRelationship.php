<?php

namespace App\Entities\JobSalary\Traits;

use App\Entities\Currency\Currency;
use App\Entities\JobSalaryType\JobSalaryType;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
