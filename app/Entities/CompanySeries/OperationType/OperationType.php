<?php

namespace App\Entities\CompanySeries\OperationType;

use App\Entities\CompanySeries\OperationType\Traits\OperationTypeRelationship;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class OperationType extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, OperationTypeRelationship;

    protected $table = 'operation_types';

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
                if (str_contains($value, '_')) {
                    return __('data/operation_types.name.' . $value) ?? $value;
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
                    return __('data/operation_types.description.' . $value) ?? $value;
                }

                return $value;
            }
        );
    }
}
