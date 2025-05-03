<?php

namespace App\Entities\ProfileSeries\UserProductResource;

use App\Entities\ProfileSeries\UserProductResource\Traits\UserProductResourceRelationship;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * 
 *
 * @property int $id
 * @property int|null $user_product_id
 * @property string $title Tiêu đề
 * @property string $path
 * @property string|null $description
 * @property int|null $content_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Entities\DefaultSeries\DefaultContentType\DefaultContentType|null $contentType
 * @property-read \App\Entities\ProfileSeries\UserProduct\UserProduct|null $userProducts
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProductResource newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProductResource newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProductResource query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProductResource whereContentTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProductResource whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProductResource whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProductResource whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProductResource wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProductResource whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProductResource whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProductResource whereUserProductId($value)
 * @mixin \Eloquent
 */
class UserProductResource extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, UserProductResourceRelationship;

    protected $table = 'user_product_resources';

    public const FILLABLE_FIELDS = [
        'user_product_id',
        'title',
        'path',
        'description',
        'content_type_id'
    ];
}
