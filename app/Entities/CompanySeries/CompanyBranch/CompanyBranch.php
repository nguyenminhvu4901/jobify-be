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

/**
 * 
 *
 * @property int $id
 * @property string $branch_name
 * @property int|null $company_id
 * @property int|null $province_id
 * @property int|null $district_id
 * @property int|null $ward_id
 * @property string|null $address
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Entities\CompanySeries\Company\Company|null $company
 * @property-read \App\Entities\Locate\District\District|null $district
 * @property-read \App\Entities\Locate\Province\Province|null $province
 * @property-read \App\Entities\Locate\Ward\Ward|null $ward
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyBranch newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyBranch newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyBranch query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyBranch searchFullText(string $keyword, array $columns, string $mode = 'NATURAL LANGUAGE MODE')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyBranch whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyBranch whereBranchName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyBranch whereByCompanyId($companyId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyBranch whereById($id)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyBranch whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyBranch whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyBranch whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyBranch whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyBranch whereProvinceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyBranch whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyBranch whereWardId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyBranch withRelationships(array|string|null $relationships)
 * @mixin \Eloquent
 */
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
