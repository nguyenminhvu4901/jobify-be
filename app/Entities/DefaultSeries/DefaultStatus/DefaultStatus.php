<?php

namespace App\Entities\DefaultSeries\DefaultStatus;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * @property int $id
 * @property string $status 1: active, 2:deactivate
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DefaultStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DefaultStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DefaultStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DefaultStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DefaultStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DefaultStatus whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DefaultStatus whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class DefaultStatus extends BaseModel implements Transformable
{
    use HasFactory;
    use TransformableTrait;

    /**
     * @var string
     */
    protected $table = 'default_statuses';

    public const FILLABLE_FIELDS = [
        'status',
    ];

    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucfirst($value)
        );
    }
}
