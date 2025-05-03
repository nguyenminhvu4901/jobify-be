<?php

namespace App\Entities\CompanySeries\Company;

use App\Entities\CompanySeries\Company\Traits\CompanyRelationship;
use App\Entities\CompanySeries\Company\Traits\CompanyScope;
use App\Models\BaseModel;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * @property int $id
 * @property int|null $user_id
 * @property int|null $company_scale_id
 * @property int|null $company_working_day_id
 * @property int|null $gender_id
 * @property int|null $status_id
 * @property string $name
 * @property string $slug
 * @property string $tax_code
 * @property string|null $website
 * @property string|null $description
 * @property string|null $avatar
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Entities\CompanySeries\BusinessSector\BusinessSector> $businessSectors
 * @property-read int|null $business_sectors_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Entities\CompanySeries\CompanyBenefit\CompanyBenefit> $companyBenefits
 * @property-read int|null $company_benefits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Entities\CompanySeries\CompanyBranch\CompanyBranch> $companyBranches
 * @property-read int|null $company_branches_count
 * @property-read \App\Entities\CompanySeries\CompanyScale\CompanyScale|null $companyScale
 * @property-read \App\Entities\CompanySeries\CompanyWorkingDay\CompanyWorkingDay|null $companyWorkingDay
 * @property-read \App\Entities\DefaultSeries\DefaultGender\DefaultGender|null $gender
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Entities\CompanySeries\OperationType\OperationType> $operationTypes
 * @property-read int|null $operation_types_count
 * @property-read \App\Entities\DefaultSeries\DefaultStatus\DefaultStatus|null $status
 * @property-read \App\Models\User|null $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereCompanyBenefitId($companyBenefitId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereCompanyBranchId($companyBranchId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereCompanyScaleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereCompanyWorkingDayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereGenderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereTaxCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereWebsite($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company withUniqueSlugConstraints(\Illuminate\Database\Eloquent\Model $model, string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company withoutTrashed()
 *
 * @mixin \Eloquent
 */
class Company extends BaseModel implements Transformable
{
    use CompanyRelationship;
    use CompanyScope;
    use HasFactory;
    use Sluggable;
    use SoftDeletes;
    use TransformableTrait;

    protected $table = 'companies';

    public const FILLABLE_FIELDS = [
        'user_id',
        'name',
        'slug',
        'company_scale_id',
        'company_working_day_id',
        'gender_id',
        'status_id',
        'website',
        'description',
        'tax_code',
        'avatar',
    ];

    /**
     * @return array[]
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => true,
            ],
        ];
    }
}
