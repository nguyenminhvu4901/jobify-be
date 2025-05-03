<?php

namespace App\Entities\CompanySeries\CompanyScale\Traits;

use App\Entities\CompanySeries\Company\Company;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait CompanyScaleRelationship
{
    public function company(): HasOne
    {
        return $this->hasOne(Company::class);
    }
}
