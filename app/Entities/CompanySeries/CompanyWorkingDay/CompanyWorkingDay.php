<?php

namespace App\Entities\CompanySeries\CompanyWorkingDay;

use App\Entities\CompanySeries\CompanyWorkingDay\Traits\CompanyWorkingDayTrait;
use App\Enums\RouteNames\CompanySeries\CompanyWorkingDayEnum;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;

class CompanyWorkingDay extends BaseModel implements Transformable
{
    use CompanyWorkingDayTrait;

    protected $table = CompanyWorkingDayEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'working_day'
    ];

}
