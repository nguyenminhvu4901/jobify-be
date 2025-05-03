<?php

namespace App\Entities\CompanySeries\CompanyBusinessSector;

use App\Entities\CompanySeries\CompanyBusinessSector\Traits\CompanyBusinessSectorRelationship;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * 
 *
 * @property int $id
 * @property int|null $company_id
 * @property int|null $business_sector_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyBusinessSector newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyBusinessSector newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyBusinessSector query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyBusinessSector whereBusinessSectorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyBusinessSector whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyBusinessSector whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyBusinessSector whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyBusinessSector whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CompanyBusinessSector extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, CompanyBusinessSectorRelationship;

    protected $table = 'company_business_sector';

    public const FILLABLE_FIELDS = [
        'company_id',
        'business_sector_id'
    ];
}
