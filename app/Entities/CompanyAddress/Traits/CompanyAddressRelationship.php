<?php

namespace App\Entities\CompanyAddress\Traits;

use App\Entities\Company\Company;
use App\Entities\District\District;
use App\Entities\Province\Province;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait CompanyAddressRelationship
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
}
