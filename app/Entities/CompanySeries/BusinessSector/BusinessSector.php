<?php

namespace App\Entities\CompanySeries\BusinessSector;

use App\Entities\CompanySeries\BusinessSector\Traits\BusinessSectorRelationship;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use App\Enums\RouteNames\Company\BusinessSectorEnum;

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
            get: function (string $value) {
                if (str_contains($value, '_')) {
                    return __('data/business_sectors.name.' . $value) ?? $value;
                }

                return $value;
            }
        );
    }

    /**
     * @return Attribute
     */
    protected function description(): Attribute
    {
        return Attribute::make(
            get: function (string $value) {
                if (str_contains($value, '_')) {
                    return __('data/business_sectors.description.' . $value) ?? $value;
                }

                return $value;
            }
        );
    }
}
