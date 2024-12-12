<?php

namespace App\Entities\CompanyScale\Traits;

use App\Entities\Company\Company;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait CompanyScaleRelationship
{
    /**
     * @return HasOne
     */
    public function company(): HasOne
    {
        return $this->hasOne(Company::class);
    }
}
