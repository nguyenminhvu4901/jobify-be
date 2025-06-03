<?php

namespace App\Entities\ProfileSeries\UserExperienceResource;

use App\Entities\ProfileSeries\UserExperienceResource\Traits\UserExperienceResourceTrait;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;

class UserExperienceResource extends BaseModel implements Transformable
{
    use UserExperienceResourceTrait;

    protected $table = 'user_experience_resources';

    public const FILLABLE_FIELDS = [
        'user_experience_id',
        'title',
        'path',
        'description',
        'content_type_id'
    ];
}
