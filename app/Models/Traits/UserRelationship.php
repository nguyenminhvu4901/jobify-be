<?php

namespace App\Models\Traits;

use App\Entities\Company\Company;
use App\Entities\DefaultGender\DefaultGender;
use App\Entities\DefaultStatus\DefaultStatus;
use App\Entities\UserActivity\UserActivity;
use App\Entities\UserCertification\UserCertification;
use App\Entities\UserCourse\UserCourse;
use App\Entities\UserEducation\UserEducation;
use App\Entities\UserExperience\UserExperience;
use App\Entities\UserPrize\UserPrize;
use App\Entities\UserProduct\UserProduct;
use App\Entities\UserProfile\UserProfile;
use App\Entities\UserProject\UserProject;
use App\Entities\UserSkill\UserSkill;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait UserRelationship
{
    /**
     * @return BelongsTo
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(DefaultStatus::class, 'status_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function gender(): BelongsTo
    {
        return $this->belongsTo(DefaultGender::class, 'gender_id', 'id');
    }

    /**
     * @return HasOne
     */
    public function company(): HasOne
    {
        return $this->hasOne(Company::class);
    }

    /**
     * @return HasOne
     */
    public function userProfile(): HasOne
    {
        return $this->hasOne(UserProfile::class);
    }

    /**
     * @return HasMany
     */
    public function userExperiences(): HasMany
    {
        return $this->hasMany(UserExperience::class);
    }

    /**
     * @return HasMany
     */
    public function userCertifications(): HasMany
    {
        return $this->hasMany(UserCertification::class);
    }

    /**
     * @return HasMany
     */
    public function userEducations(): HasMany
    {
        return $this->hasMany(UserEducation::class);
    }

    /**
     * @return HasMany
     */
    public function userSkills(): HasMany
    {
        return $this->hasMany(UserSkill::class);
    }

    /**
     * @return HasMany
     */
    public function userCourses(): HasMany
    {
        return $this->hasMany(UserCourse::class);
    }

    /**
     * @return HasMany
     */
    public function userProjects(): HasMany
    {
        return $this->hasMany(UserProject::class);
    }

    /**
     * @return HasMany
     */
    public function userPrizes(): HasMany
    {
        return $this->hasMany(UserPrize::class);
    }

    /**
     * @return HasMany
     */
    public function userProducts(): HasMany
    {
        return $this->hasMany(UserProduct::class);
    }

    /**
     * @return HasMany
     */
    public function userActivities(): HasMany
    {
        return $this->hasMany(UserActivity::class);
    }
}
