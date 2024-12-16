<?php

namespace App\Entities\UserPrize;

use App\Entities\UserPrize\Traits\UserPrizeRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UserPrize extends Model implements Transformable
{
    use TransformableTrait, HasFactory, UserPrizeRelationship;

    protected $table = 'UserPrize';

    protected $fillable = [
        'user_id',
        'name',
        'organization',
        'start_date',
        'end_date'
    ];
}
