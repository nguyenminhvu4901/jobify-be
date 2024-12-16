<?php

namespace App\Entities\UserExperience;

use App\Entities\UserExperience\Traits\UserExperienceRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UserExperience extends Model implements Transformable
{
    use TransformableTrait, HasFactory, UserExperienceRelationship;

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
