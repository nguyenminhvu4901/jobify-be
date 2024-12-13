<?php

namespace App\Entities\UserProject;

use App\Entities\UserProject\Traits\UserProjectRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UserProject extends Model implements Transformable
{
    use TransformableTrait, HasFactory, UserProjectRelationship;

    protected $table = 'user_projects';

    protected $fillable = [
        'user_id',
        'name',
        'client',
        'member',
        'position',
        'mission',
        'technology',
        'from_date',
        'to_date',
        'description'
    ];
}
