<?php

namespace App\Entities\UserPrizeResource;

use App\Entities\UserPrize\Traits\UserPrizeRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UserPrizeResource extends Model implements Transformable
{
    use TransformableTrait, HasFactory, UserPrizeRelationship;

    protected $table = 'user_prize_resources';

    protected $fillable = [
        'user_prize_id',
        'title',
        'path',
        'description',
        'content_type_id'
    ];
}
