<?php

namespace App\Entities\DefaultSeries\DefaultContentType;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * @property int $id
 * @property string $content_type 1:image, 2:file, 3:url, 4:video
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DefaultContentType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DefaultContentType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DefaultContentType query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DefaultContentType whereContentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DefaultContentType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DefaultContentType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DefaultContentType whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class DefaultContentType extends BaseModel implements Transformable
{
    use HasFactory;
    use TransformableTrait;

    protected $table = 'default_content_types';

    public const FILLABLE_FIELDS = [
        'content_type',
    ];
}
