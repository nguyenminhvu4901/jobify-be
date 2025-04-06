<?php

namespace App\Entities\ProfileSeries\UserPrizeResource;

use App\Entities\ProfileSeries\UserPrizeResource\Traits\UserPrizeResourceRelationship;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UserPrizeResource extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, UserPrizeResourceRelationship;

    protected $table = 'user_prize_resources';

    public const FILLABLE_FIELDS = [
        'user_prize_id',
        'title',
        'path',
        'description',
        'content_type_id'
    ];
}
