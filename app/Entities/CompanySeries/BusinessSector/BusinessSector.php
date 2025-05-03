<?php

namespace App\Entities\CompanySeries\BusinessSector;

use App\Entities\CompanySeries\BusinessSector\Traits\BusinessSectorRelationship;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use App\Enums\RouteNames\CompanySeries\BusinessSectorEnum;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int|null $parent_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, BusinessSector> $children
 * @property-read int|null $children_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Entities\CompanySeries\Company\Company> $companies
 * @property-read int|null $companies_count
 * @property-read BusinessSector|null $parent
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusinessSector newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusinessSector newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusinessSector query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusinessSector whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusinessSector whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusinessSector whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusinessSector whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusinessSector whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusinessSector whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BusinessSector extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, BusinessSectorRelationship;

    protected $table = BusinessSectorEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'name',
        'description',
        'parent_id'
    ];

    /**
     * @return Attribute
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) =>
            translatable_or_original('data/company_series/business_sectors.name', $value)
        );
    }

    /**
     * @return Attribute
     */
    protected function description(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) =>
            translatable_or_original('data/company_series/business_sectors.description', $value)
        );
    }
}
