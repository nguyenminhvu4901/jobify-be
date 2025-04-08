<?php

namespace App\Entities\CompanySeries\CompanyBranch;

use App\Entities\CompanySeries\CompanyBranch\Traits\CompanyBranchRelationship;
use App\Entities\CompanySeries\CompanyBranch\Traits\CompanyBranchScope;
use App\Enums\RouteNames\CompanySeries\CompanyBranchEnum;
use App\Models\BaseModel;
use App\Traits\Scope\BaseScopeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class CompanyBranch extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory,
        CompanyBranchRelationship, CompanyBranchScope, BaseScopeTrait;

    protected $table = CompanyBranchEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'branch_name',
        'company_id',
        'province_id',
        'district_id',
        'ward_id',
        'address'
    ];
}
