<?php

namespace App\Entities\CompanySeries\CompanyBenefit;

use App\Entities\CompanySeries\CompanyBenefit\Traits\CompanyBenefitRelationship;
use App\Entities\CompanySeries\CompanyBenefit\Traits\CompanyBenefitScope;
use App\Enums\RouteNames\CompanySeries\CompanyBenefitEnum;
use App\Models\BaseModel;
use App\Traits\Scope\BaseScopeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class CompanyBenefit extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, CompanyBenefitRelationship, CompanyBenefitScope, BaseScopeTrait;

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
