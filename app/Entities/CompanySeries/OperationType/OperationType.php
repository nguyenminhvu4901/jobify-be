<?php

namespace App\Entities\CompanySeries\OperationType;

use App\Entities\CompanySeries\OperationType\Traits\OperationTypeTrait;
use App\Enums\RouteNames\CompanySeries\OperationTypeEnum;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;

class OperationType extends BaseModel implements Transformable
{
    use OperationTypeTrait;

    protected $table = OperationTypeEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'name',
        'description'
    ];
}
