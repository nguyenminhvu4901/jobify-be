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

/**
 * 
 *
 * @property int $id
 * @property int|null $company_id
 * @property string $benefit_name
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Entities\CompanySeries\Company\Company|null $companies
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyBenefit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyBenefit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyBenefit query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyBenefit searchFullText(string $keyword, array $columns, string $mode = 'NATURAL LANGUAGE MODE')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyBenefit whereBenefitName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyBenefit whereByCompanyId($companyId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyBenefit whereById($id)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyBenefit whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyBenefit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyBenefit whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyBenefit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyBenefit whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyBenefit withRelationships(array|string|null $relationships)
 * @mixin \Eloquent
 */
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
