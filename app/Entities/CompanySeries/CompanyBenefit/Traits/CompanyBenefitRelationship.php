<?php

namespace App\Entities\CompanySeries\CompanyBenefit\Traits;

use App\Entities\CompanySeries\Company\Company;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait CompanyBenefitRelationship
{
    public function companies(): BelongsTo
    {
        return $this->belongsTo(Company::class)->withDefault();
    }
}
