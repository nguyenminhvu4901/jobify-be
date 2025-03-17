<?php

namespace App\Entities\Company\Traits;

use App\Entities\CompanyBranch\CompanyBranch;
use App\Entities\CompanyScale\CompanyScale;
use App\Entities\DefaultGender\DefaultGender;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
}
