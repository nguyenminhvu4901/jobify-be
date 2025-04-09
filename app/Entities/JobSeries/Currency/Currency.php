<?php

namespace App\Entities\JobSeries\Currency;

use App\Entities\JobSeries\Currency\Traits\CurrencyRelationship;
use App\Enums\RouteNames\JobSeries\CurrencyEnum;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Currency extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, CurrencyRelationship;

    protected $table = CurrencyEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'name'
    ];

    /**
     * @return Attribute
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => strtoupper($value)

        );
    }
}
