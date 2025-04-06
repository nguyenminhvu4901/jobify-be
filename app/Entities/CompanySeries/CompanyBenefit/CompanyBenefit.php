<?php

namespace App\Entities\CompanySeries\CompanyBenefit;

use App\Entities\CompanySeries\CompanyBenefit\Traits\CompanyBenefitRelationship;
use App\Entities\CompanySeries\CompanyBenefit\Traits\CompanyBenefitScope;
use App\Traits\Scope\BaseScopeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class CompanyBenefit extends Model implements Transformable
{
    use TransformableTrait, HasFactory, CompanyBenefitRelationship, CompanyBenefitScope, BaseScopeTrait;

    /**
     * @var string
     */
    protected $table = "company_benefits";

    public const FILLABLE_FIELDS = [
        'company_id',
        'benefit_name',
        'description'
    ];

    /**
     * @var string[]
     */
    protected $fillable = self::FILLABLE_FIELDS;
}
