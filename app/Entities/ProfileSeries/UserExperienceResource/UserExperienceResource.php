<?php

namespace App\Entities\ProfileSeries\UserExperienceResource;

use App\Entities\ProfileSeries\UserExperienceResource\Traits\UserExperienceResourceRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UserExperienceResource extends Model implements Transformable
{
    use TransformableTrait, HasFactory, UserExperienceResourceRelationship;

    protected $table = 'user_experience_resources';

    protected $fillable = [
        'user_experience_id',
        'title',
        'path',
        'description',
        'content_type_id'
    ];
}
