<?php

namespace App\Entities\User;

use App\Entities\User\Traits\UserRelationship;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class User extends \App\Models\User implements Transformable
{
    use TransformableTrait;

    protected $guard_name = 'api';
}
