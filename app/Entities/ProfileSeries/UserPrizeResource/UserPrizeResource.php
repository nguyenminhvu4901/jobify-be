<?php

namespace App\Entities\ProfileSeries\UserPrizeResource;

use App\Entities\ProfileSeries\UserPrizeResource\Traits\UserPrizeResourceTrait;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;

class UserPrizeResource extends BaseModel implements Transformable
{
    use UserPrizeResourceTrait;

    protected $table = 'user_prize_resources';

    public const FILLABLE_FIELDS = [
        'user_prize_id',
        'title',
        'path',
        'description',
        'content_type_id'
    ];
}
