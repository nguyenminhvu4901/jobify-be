<?php

namespace App\Entities\BusinessSector\Traits;

use App\Entities\BusinessSector\BusinessSector;
use App\Entities\Company\Company;
use App\Entities\CompanyBusinessSector\CompanyBusinessSector;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait BusinessSectorRelationship
{
    /**
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(BusinessSector::class, 'parent_id');
    }

    /**
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(BusinessSector::class, 'parent_id');
    }

    /**
     * @return BelongsToMany
     */
    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class, CompanyBusinessSector::class,
            'business_sector_id', 'company_id',
            'id', 'id'
        );
    }
}
