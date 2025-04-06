<?php

namespace App\Entities\ProfileSeries\UserPrize;

use App\Entities\ProfileSeries\UserPrize\Traits\UserPrizeRelationship;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UserPrize extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, UserPrizeRelationship;

    protected $table = 'user_prizes';

    public const FILLABLE_FIELDS = [
        'user_id',
        'name',
        'organization',
        'start_date',
        'end_date'
    ];
}
