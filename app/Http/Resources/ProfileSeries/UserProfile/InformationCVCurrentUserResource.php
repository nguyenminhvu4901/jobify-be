<?php

namespace App\Http\Resources\ProfileSeries\UserProfile;

use App\Http\Resources\ProfileSeries\UserActivity\UserActivityNoUserDataResource;
use App\Http\Resources\ProfileSeries\UserCertification\UserCertificationNoUserDataResource;
use App\Http\Resources\ProfileSeries\UserCourse\UserCourseNoUserDataResource;
use App\Http\Resources\ProfileSeries\UserEducation\UserEducationNoUserDataResource;
use App\Http\Resources\ProfileSeries\UserExperience\UserExperienceNoUserDataResource;
use App\Http\Resources\ProfileSeries\UserLocation\UserLocationNoUserDataResource;
use App\Http\Resources\ProfileSeries\UserPrize\UserPrizeNoUserDataResource;
use App\Http\Resources\ProfileSeries\UserProduct\UserProductNoUserDataResource;
use App\Http\Resources\ProfileSeries\UserProject\UserProjectNoUserDataResource;
use App\Http\Resources\ProfileSeries\UserSkill\UserSkillNoUserDataResource;
use App\Http\Resources\Role\RoleResource;
use App\Traits\Resources\UserResourceTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InformationCVCurrentUserResource extends JsonResource
{
    use UserResourceTrait;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            ...$this->userData(),
            'roles' => RoleResource::collection($this->roles),
            'profile' => new ProfileResource($this->userProfile),
            'user_experiences' => UserExperienceNoUserDataResource::collection($this?->userExperiences),
            'user_certifications' => UserCertificationNoUserDataResource::collection($this?->userCertifications),
            'user_educations' => UserEducationNoUserDataResource::collection($this?->userEducations),
            'user_skills' => UserSkillNoUserDataResource::collection($this?->userSkills),
            'user_courses' => UserCourseNoUserDataResource::collection($this->userCourses),
            'user_projects' => UserProjectNoUserDataResource::collection($this->userProjects),
            'user_prizes' => UserPrizeNoUserDataResource::collection($this->userPrizes),
            'user_products' => UserProductNoUserDataResource::collection($this->userProducts),
            'user_activities' => UserActivityNoUserDataResource::collection($this->userActivities),
            'user_locations' => UserLocationNoUserDataResource::collection($this->userLocations)
        ];
    }
}
