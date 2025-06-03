<?php

namespace App\Entities\CompanySeries\CompanyBranch;

use App\Entities\CompanySeries\CompanyBranch\Traits\CompanyBranchTrait;
use App\Enums\RouteNames\CompanySeries\CompanyBranchEnum;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;

class CompanyBranch extends BaseModel implements Transformable
{
    use CompanyBranchTrait;

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
