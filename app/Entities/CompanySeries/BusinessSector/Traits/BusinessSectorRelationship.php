<?php

namespace App\Entities\CompanySeries\BusinessSector\Traits;

use App\Entities\CompanySeries\BusinessSector\BusinessSector;
use App\Entities\CompanySeries\Company\Company;
use App\Entities\CompanySeries\CompanyBusinessSector\CompanyBusinessSector;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait BusinessSectorRelationship
{
    public function parent(): BelongsTo
    {
        return $this->belongsTo(BusinessSector::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(BusinessSector::class, 'parent_id');
    }

    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(
            Company::class,
            CompanyBusinessSector::class,
            'business_sector_id',
            'company_id',
            'id',
            'id'
        )->withTimestamps();
    }
}
