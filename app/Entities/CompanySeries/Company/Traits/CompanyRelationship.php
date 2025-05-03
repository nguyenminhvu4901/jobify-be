<?php

namespace App\Entities\CompanySeries\Company\Traits;

use App\Entities\CompanySeries\BusinessSector\BusinessSector;
use App\Entities\CompanySeries\CompanyBenefit\CompanyBenefit;
use App\Entities\CompanySeries\CompanyBranch\CompanyBranch;
use App\Entities\CompanySeries\CompanyBusinessSector\CompanyBusinessSector;
use App\Entities\CompanySeries\CompanyOperationType\CompanyOperationType;
use App\Entities\CompanySeries\CompanyScale\CompanyScale;
use App\Entities\CompanySeries\CompanyWorkingDay\CompanyWorkingDay;
use App\Entities\CompanySeries\OperationType\OperationType;
use App\Entities\DefaultSeries\DefaultGender\DefaultGender;
use App\Entities\DefaultSeries\DefaultStatus\DefaultStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait CompanyRelationship
{
    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withDefault();
    }

    /**
     * @return BelongsTo
     */
    public function gender(): BelongsTo
    {
        return $this->belongsTo(DefaultGender::class, 'gender_id', 'id')->withDefault();
    }

    /**
     * @return BelongsTo
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(DefaultStatus::class, 'status_id', 'id')->withDefault();
    }

    /**
     * @return BelongsTo
     */
    public function companyScale(): BelongsTo
    {
        return $this->belongsTo(CompanyScale::class, 'company_scale_id', 'id')->withDefault();
    }

    /**
     * @return hasMany
     */
    public function companyBranches(): hasMany
    {
        return $this->hasMany(CompanyBranch::class);
    }

    /**
     * @return BelongsTo
     */
    public function companyWorkingDay(): BelongsTo
    {
        return $this->belongsTo(CompanyWorkingDay::class);
    }

    /**
     * @return BelongsToMany
     */
    public function operationTypes(): BelongsToMany
    {
        return $this->belongsToMany(OperationType::class, CompanyOperationType::class)
            ->withTimestamps();
    }

    /**
     * @return BelongsToMany
     */
    public function businessSectors(): BelongsToMany
    {
        return $this->belongsToMany(BusinessSector::class, CompanyBusinessSector::class)
            ->withTimestamps();
    }

    /**
     * @return HasMany
     */
    public function companyBenefits(): HasMany
    {
        return $this->hasMany(CompanyBenefit::class);
    }
}
