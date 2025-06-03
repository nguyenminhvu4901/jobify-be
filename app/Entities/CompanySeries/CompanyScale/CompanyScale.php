<?php

namespace App\Entities\CompanySeries\CompanyScale;

use App\Entities\CompanySeries\CompanyScale\Traits\CompanyScaleTrait;
use App\Enums\RouteNames\CompanySeries\CompanyScaleEnum;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;

class CompanyScale extends BaseModel implements Transformable
{
    use CompanyScaleTrait;

    protected $table = CompanyScaleEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'name', 'description'
    ];
}
