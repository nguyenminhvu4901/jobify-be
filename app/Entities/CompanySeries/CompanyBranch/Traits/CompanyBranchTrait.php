<?php

namespace App\Entities\CompanySeries\CompanyBranch\Traits;

use App\Traits\Scope\BaseScopeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Traits\TransformableTrait;

trait CompanyBranchTrait
{
    use TransformableTrait, HasFactory,
        CompanyBranchRelationship, CompanyBranchScope, BaseScopeTrait;
}
