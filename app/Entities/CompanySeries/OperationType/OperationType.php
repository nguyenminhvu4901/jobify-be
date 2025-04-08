<?php

namespace App\Entities\CompanySeries\OperationType;

use App\Entities\CompanySeries\OperationType\Traits\OperationTypeRelationship;
use App\Enums\RouteNames\Company\OperationTypeEnum;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

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
            get: function (string $value) {
                return __('data/company_series/operation_types.name.' . $value) ?? $value;
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
                return __('data/company_series/operation_types.description.' . $value) ?? $value;
            }
        );
    }
}
