<?php

namespace App\Entities\CompanySeries\CompanyBranch\Traits;

use App\Entities\CompanySeries\Company\Company;
use App\Entities\Locate\District\District;
use App\Entities\Locate\Province\Province;
use App\Entities\Locate\Ward\Ward;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait CompanyBranchRelationship
{
    /**
     * @return BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id', 'id')->withDefault();
    }

    /**
     * @return BelongsTo
     */
    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'province_id', 'id')->withDefault();
    }

    /**
     * @return BelongsTo
     */
    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class, 'district_id', 'id')->withDefault();
    }

    /**
     * @return BelongsTo
     */
    public function ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class, 'ward_id', 'id')->withDefault();
    }
}
