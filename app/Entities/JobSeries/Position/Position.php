<?php

namespace App\Entities\JobSeries\Position;

use App\Entities\JobSeries\Position\Traits\PositionTrait;
use App\Enums\RouteNames\JobSeries\PositionEnum;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;

class Position extends BaseModel implements Transformable
{
    use PositionTrait;

    /**
     * @var string
     */
    protected $table = PositionEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'name',
        '_lft',
        '_rgt',
        'parent_id'
    ];

}
