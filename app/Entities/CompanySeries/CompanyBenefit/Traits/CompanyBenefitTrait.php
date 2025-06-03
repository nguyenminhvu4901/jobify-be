<?php

namespace App\Entities\CompanySeries\CompanyBenefit\Traits;

use App\Traits\Scope\BaseScopeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Traits\TransformableTrait;

trait CompanyBenefitTrait
{
    use TransformableTrait, HasFactory, CompanyBenefitRelationship, CompanyBenefitScope, BaseScopeTrait;
}
