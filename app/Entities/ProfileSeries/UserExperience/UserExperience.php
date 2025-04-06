<?php

namespace App\Entities\ProfileSeries\UserExperience;

use App\Entities\ProfileSeries\UserExperience\Traits\UserExperienceRelationship;
use App\Entities\ProfileSeries\UserExperience\Traits\UserExperienceScope;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UserExperience extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, UserExperienceRelationship, UserExperienceScope;

    protected $table = 'user_experiences';

    public const FILLABLE_FIELDS = [
        'user_id',
        'name',
        'position',
        'is_working',
        'start_date',
        'end_date'
    ];
}
