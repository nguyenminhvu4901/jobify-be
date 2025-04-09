<?php

namespace App\Entities\CompanySeries\CompanyScale;

use App\Entities\CompanySeries\CompanyScale\Traits\CompanyScaleRelationship;
use App\Enums\RouteNames\CompanySeries\CompanyScaleEnum;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class CompanyScale extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, CompanyScaleRelationship;

    protected $table = CompanyScaleEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'name', 'description'
    ];

    /**
     * @return Attribute
     */
    protected function description(): Attribute
    {
        return Attribute::make(
            get: fn($value) => translatable_or_original('data/company_series/company_scales', $value)
        );
    }

    /**
     * @return Attribute
     */
    protected function display(): Attribute
    {
        return Attribute::make(
            get: function () {
                return str_contains($this->name, '-')
                    ? str_replace('-', $this->description, $this->name)
                    : $this->description . " " . $this->name;
            }
        );
    }
}
