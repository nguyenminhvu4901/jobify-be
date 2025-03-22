<?php

namespace App\Entities\ProfileSeries\UserSkill;

use App\Entities\ProfileSeries\UserSkill\Traits\UserSkillRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UserSkill extends Model implements Transformable
{
    use TransformableTrait, HasFactory, UserSkillRelationship;

    protected $table = 'user_skills';

    protected $fillable = [
        'user_id',
        'name',
        'rate_id',
        'description'
    ];
}
