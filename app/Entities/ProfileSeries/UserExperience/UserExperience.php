<?php

namespace App\Entities\ProfileSeries\UserExperience;

use App\Entities\ProfileSeries\UserExperience\Traits\UserExperienceRelationship;
use App\Entities\ProfileSeries\UserExperience\Traits\UserExperienceScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UserExperience extends Model implements Transformable
{
    use TransformableTrait, HasFactory, UserExperienceRelationship, UserExperienceScope;

    protected $table = 'user_experiences';

    protected $fillable = [
        'user_id',
        'name',
        'position',
        'is_working',
        'start_date',
        'end_date'
    ];
}
