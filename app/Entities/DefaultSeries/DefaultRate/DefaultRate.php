<?php

namespace App\Entities\DefaultSeries\DefaultRate;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * 
 *
 * @property int $id
 * @property string $rate 1:1 sao.... 5: 5 sao
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DefaultRate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DefaultRate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DefaultRate query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DefaultRate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DefaultRate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DefaultRate whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DefaultRate whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DefaultRate extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory;

    protected $table = 'default_rates';

    public const FILLABLE_FIELDS = [
        'rate'
    ];
}
