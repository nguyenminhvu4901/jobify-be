<?php

namespace App\Entities\UserActivity;

use App\Entities\UserActivity\Traits\UserActivityRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UserActivity extends Model implements Transformable
{
    use TransformableTrait, HasFactory, UserActivityRelationship;

    protected $table = 'user_activities';

    protected $fillable = [
        'user_id',
        'name',
        'position',
        'from_date',
        'to_date',
        'description'
    ];
}
