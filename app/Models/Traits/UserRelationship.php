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
    public function status(): BelongsTo
    {
        return $this->belongsTo(DefaultStatus::class, 'status_id', 'id');
    }

    public function gender(): BelongsTo
    {
        return $this->belongsTo(DefaultGender::class, 'gender_id', 'id');
    }

    public function company(): HasOne
    {
        return $this->hasOne(Company::class);
    }

    public function userProfile(): HasOne
    {
        return $this->hasOne(UserProfile::class);
    }

    public function userExperiences(): HasMany
    {
        return $this->hasMany(UserExperience::class);
    }

    public function userCertifications(): HasMany
    {
        return $this->hasMany(UserCertification::class);
    }

    public function userEducations(): HasMany
    {
        return $this->hasMany(UserEducation::class);
    }

    public function userSkills(): HasMany
    {
        return $this->hasMany(UserSkill::class);
    }

    public function userCourses(): HasMany
    {
        return $this->hasMany(UserCourse::class);
    }

    public function userProjects(): HasMany
    {
        return $this->hasMany(UserProject::class);
    }

    public function userPrizes(): HasMany
    {
        return $this->hasMany(UserPrize::class);
    }

    public function userProducts(): HasMany
    {
        return $this->hasMany(UserProduct::class);
    }

    public function userActivities(): HasMany
    {
        return $this->hasMany(UserActivity::class);
    }

    public function userLocations(): HasMany
    {
        return $this->hasMany(UserLocation::class);
    }
}
