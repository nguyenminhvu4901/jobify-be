<?php

namespace App\Models\Traits;

use App\Entities\CompanySeries\Company\Company;
use App\Entities\DefaultSeries\DefaultGender\DefaultGender;
use App\Entities\DefaultSeries\DefaultStatus\DefaultStatus;
use App\Entities\ProfileSeries\UserActivity\UserActivity;
use App\Entities\ProfileSeries\UserCertification\UserCertification;
use App\Entities\ProfileSeries\UserCourse\UserCourse;
use App\Entities\ProfileSeries\UserEducation\UserEducation;
use App\Entities\ProfileSeries\UserExperience\UserExperience;
use App\Entities\ProfileSeries\UserLocation\UserLocation;
use App\Entities\ProfileSeries\UserPrize\UserPrize;
use App\Entities\ProfileSeries\UserProduct\UserProduct;
use App\Entities\ProfileSeries\UserProfile\UserProfile;
use App\Entities\ProfileSeries\UserProject\UserProject;
use App\Entities\ProfileSeries\UserSkill\UserSkill;
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

    /**
     * @return HasMany
     */
    public function userLocations(): HasMany
    {
        return $this->hasMany(UserLocation::class);
    }
}
