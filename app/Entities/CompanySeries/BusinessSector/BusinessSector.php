<?php

namespace App\Entities\CompanySeries\BusinessSector;

use App\Entities\CompanySeries\BusinessSector\Traits\BusinessSectorTrait;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;
use App\Enums\RouteNames\CompanySeries\BusinessSectorEnum;

class BusinessSector extends BaseModel implements Transformable
{
    use BusinessSectorTrait;

    protected $table = BusinessSectorEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'name',
        'description',
        'parent_id'
    ];
}
