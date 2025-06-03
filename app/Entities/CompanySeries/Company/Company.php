<?php

namespace App\Entities\CompanySeries\Company;

use App\Entities\CompanySeries\Company\Traits\CompanyTrait;
use App\Enums\RouteNames\CompanySeries\CompanyProfileEnum;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;

class Company extends BaseModel implements Transformable
{
    use CompanyTrait;

    protected $table = CompanyProfileEnum::TAG_NAME->value;

    public const FILLABLE_FIELDS = [
        'user_id',
        'name',
        'slug',
        'company_scale_id',
        'company_working_day_id',
        'gender_id',
        'status_id',
        'website',
        'description',
        'tax_code',
        'avatar'
    ];
}
