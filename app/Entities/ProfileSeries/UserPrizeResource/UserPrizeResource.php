<?php

namespace App\Entities\ProfileSeries\UserPrizeResource;

use App\Entities\ProfileSeries\UserPrizeResource\Traits\UserPrizeResourceRelationship;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * 
 *
 * @property int $id
 * @property int|null $user_prize_id
 * @property string $title Tiêu đề
 * @property string $path
 * @property string|null $description
 * @property int|null $content_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Entities\DefaultSeries\DefaultContentType\DefaultContentType|null $contentType
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPrizeResource newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPrizeResource newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPrizeResource query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPrizeResource whereContentTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPrizeResource whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPrizeResource whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPrizeResource whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPrizeResource wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPrizeResource whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPrizeResource whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPrizeResource whereUserPrizeId($value)
 * @mixin \Eloquent
 */
class UserPrizeResource extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, UserPrizeResourceRelationship;

    protected $table = 'user_prize_resources';

    public const FILLABLE_FIELDS = [
        'user_prize_id',
        'title',
        'path',
        'description',
        'content_type_id'
    ];
}
