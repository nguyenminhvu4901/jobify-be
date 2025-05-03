<?php

namespace App\Entities\JobSeries\Currency;

use App\Entities\JobSeries\Currency\Traits\CurrencyRelationship;
use App\Enums\RouteNames\JobSeries\CurrencyEnum;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Currency extends BaseModel implements Transformable
{
    use CurrencyRelationship;
    use HasFactory;
    use TransformableTrait;

    protected $table = CurrencyEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'name',
    ];

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => strtoupper($value)
        );
    }
}
