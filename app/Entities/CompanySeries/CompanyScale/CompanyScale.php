<?php

namespace App\Entities\CompanySeries\CompanyScale;

use App\Entities\CompanySeries\CompanyScale\Traits\CompanyScaleRelationship;
use App\Enums\RouteNames\CompanySeries\CompanyScaleEnum;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Entities\CompanySeries\Company\Company|null $company
 * @property-read mixed $display
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyScale newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyScale newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyScale query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyScale whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyScale whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyScale whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyScale whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyScale whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class CompanyScale extends BaseModel implements Transformable
{
    use CompanyScaleRelationship;
    use HasFactory;
    use TransformableTrait;

    protected $table = CompanyScaleEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'name', 'description',
    ];

    protected function description(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => translatable_or_original('data/company_series/company_scales', $value)
        );
    }

    protected function display(): Attribute
    {
        return Attribute::make(
            get: function () {
                return str_contains($this->name, '-')
                    ? str_replace('-', $this->description, $this->name)
                    : $this->description.' '.$this->name;
            }
        );
    }
}
