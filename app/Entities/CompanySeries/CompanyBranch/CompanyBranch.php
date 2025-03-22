<?php

namespace App\Entities\CompanySeries\CompanyBranch;

use App\Entities\CompanySeries\CompanyBranch\Traits\CompanyBranchRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class CompanyBranch extends Model implements Transformable
{
    use TransformableTrait, HasFactory, CompanyBranchRelationship;

    protected $table = "company_branches";

    protected $fillable = [
        'branch_name',
        'company_id',
        'province_id',
        'district_id',
        'ward_id',
        'address'
    ];
}
