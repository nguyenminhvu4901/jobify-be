<?php

namespace App\Entities\ProfileSeries\UserProduct;

use App\Entities\ProfileSeries\UserProduct\Traits\UserProductTrait;
use App\Enums\RouteNames\Profile\UserProductEnum;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;

class UserProduct extends BaseModel implements Transformable
{
    use UserProductTrait;

    protected $table = UserProductEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'user_id',
        'name',
        'category',
        'finished_date',
        'description'
    ];
}
