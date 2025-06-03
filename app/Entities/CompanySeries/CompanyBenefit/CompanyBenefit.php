<?php

namespace App\Entities\CompanySeries\CompanyBenefit;

use App\Entities\CompanySeries\CompanyBenefit\Traits\CompanyBenefitTrait;
use App\Enums\RouteNames\CompanySeries\CompanyBenefitEnum;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;

class CompanyBenefit extends BaseModel implements Transformable
{
    use CompanyBenefitTrait;

    /**
     * @var string
     */
    protected $table = CompanyBenefitEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'company_id',
        'benefit_name',
        'description'
    ];
}
