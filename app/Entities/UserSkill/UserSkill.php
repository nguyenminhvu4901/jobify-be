<?php

namespace App\Entities\UserSkill;

use App\Entities\UserSkill\Traits\UserSkillRelationship;
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
