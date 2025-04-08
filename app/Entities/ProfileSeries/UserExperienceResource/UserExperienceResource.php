<?php

namespace App\Entities\ProfileSeries\UserExperienceResource;

use App\Entities\ProfileSeries\UserExperienceResource\Traits\UserExperienceResourceRelationship;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UserExperienceResource extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, UserExperienceResourceRelationship;

    protected $table = 'user_experience_resources';

    public const FILLABLE_FIELDS = [
        'user_experience_id',
        'title',
        'path',
        'description',
        'content_type_id'
    ];
}
