<?php

namespace App\Entities\CompanySeries\OperationType;

use App\Entities\CompanySeries\OperationType\Traits\OperationTypeRelationship;
use App\Enums\RouteNames\CompanySeries\OperationTypeEnum;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Entities\CompanySeries\Company\Company> $companies
 * @property-read int|null $companies_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperationType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperationType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperationType query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperationType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperationType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperationType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperationType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperationType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OperationType extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, OperationTypeRelationship;

    protected $table = OperationTypeEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'name',
        'description'
    ];

    /**
     * @return Attribute
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => translatable_or_original('data/company_series/operation_types.name', $value)
        );
    }

    /**
     * @return Attribute
     */
    protected function description(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => translatable_or_original('data/company_series/operation_types.description', $value)
        );
    }
}
