<?php

namespace App\Entities\ProfileSeries\UserActivityResource;

use App\Entities\ProfileSeries\UserActivityResource\Traits\UserActivityResourceRelationship;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * @property int $id
 * @property int|null $user_activity_id
 * @property string $title Tiêu đề
 * @property string $path
 * @property string|null $description
 * @property int|null $content_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Entities\DefaultSeries\DefaultContentType\DefaultContentType|null $contentType
 * @property-read \App\Entities\ProfileSeries\UserActivity\UserActivity|null $userActivity
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserActivityResource newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserActivityResource newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserActivityResource query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserActivityResource whereContentTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserActivityResource whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserActivityResource whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserActivityResource whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserActivityResource wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserActivityResource whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserActivityResource whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserActivityResource whereUserActivityId($value)
 *
 * @mixin \Eloquent
 */
class UserActivityResource extends BaseModel implements Transformable
{
    use HasFactory;
    use TransformableTrait;
    use UserActivityResourceRelationship;

    protected $table = 'user_activity_resources';

    public const FILLABLE_FIELDS = [
        'user_activity_id',
        'title',
        'path',
        'description',
        'content_type_id',
    ];
}
